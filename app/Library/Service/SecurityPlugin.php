<?php

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Library\Service;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Component;
use Phalcon\Acl\Enum;
use Phalcon\Acl\Role;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Injectable
{
    /**
     * This action is executed before execute any action in the application
     *
     * @param Event      $event
     * @param Dispatcher $dispatcher
     *
     * @return bool
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $auth = $this->session->get('auth');
        if (!$auth) {
            $role = 'Guests';
        } else {
            // $role = 'Users'; // TODO: edit it
            $role = 'Super Admin';
        }

        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        $acl = $this->getAcl();

        if (!$acl->isComponent($controller)) {
            $dispatcher->forward([
                'namespace'  => 'App\Controllers',
                'controller' => 'errors',
                'action'     => 'show404',
            ]);

            return false;
        }

        $allowed = $acl->isAllowed($role, $controller, $action);
        if (!$allowed) {
            $dispatcher->forward([
                'namespace'  => 'App\Controllers',
                'controller' => 'errors',
                'action'     => 'show401',
            ]);

            return false;
        }

        return true;
    }

    /**
     * Returns an existing or new access control list
     *
     * @returns AclList
     */
    protected function getAcl(): AclList
    {
        if (isset($this->persistent->acl)) {
            return $this->persistent->acl;
        }

        $acl = new AclList();
        $acl->setDefaultAction(Enum::DENY);

        // Register roles
        $roles = [
            'super_admin'  => new Role(
                'Super Admin',
                'Only super admin.'
            ),
            'users'  => new Role(
                'Users',
                'Member privileges, granted after sign in.'
            ),
            'guests' => new Role(
                'Guests',
                'Anyone browsing the site who is not signed in is considered to be a "Guest".'
            )
        ];

        foreach ($roles as $role) {
            $acl->addRole($role);
        }

        //Private area resources
        $adminResources = [
            'dashboard'    => ['index'],
            'companies'    => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
            'products'     => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
            'producttypes' => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
            'invoices'     => ['index', 'profile'],
        ];
        foreach ($adminResources as $resource => $actions) {
            $acl->addComponent(new Component($resource), $actions);
        }

        //Public area resources
        $publicResources = [
            'index'    => ['index'],
            'about'    => ['index'],
            'register' => ['index'],
            'login'    => ['index'],
            'errors'   => ['show401', 'show404', 'show500'],
            'session'  => ['index', 'register', 'start', 'end'],
            'contact'  => ['index', 'send'],
        ];
        foreach ($publicResources as $resource => $actions) {
            $acl->addComponent(new Component($resource), $actions);
        }

        //Grant access to public areas to both users and guests
        foreach ($roles as $role) {
            foreach ($publicResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow($role->getName(), $resource, $action);
                }
            }
        }

        //Grant access to private area to role Users
        foreach ($adminResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow('Super Admin', $resource, $action);
            }
        }

        //The acl is stored in session, APC would be useful here too
        $this->persistent->acl = $acl;

        return $acl;
    }
}
