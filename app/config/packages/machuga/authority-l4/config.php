<?php

return array(

    'initialize' => function($authority) {

        $user = $authority->getCurrentUser();

        if ($user)
        {
            ///////////////////////////////////////////////////////////////////
            // Action aliases ////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////

            $authority->addAlias('view', ['read']);
            $authority->addAlias('edit', ['read', 'update']);
            $authority->addAlias('moderate', ['read', 'update', 'delete']);
            $authority->addAlias('manage', ['create', 'read', 'update', 'delete']);
            $authority->addAlias('superuser', ['create', 'read', 'update', 'delete']);


            ///////////////////////////////////////////////////////////////////
            // No Access /////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////

            // Users must have at least one role
            if (count($user->roles) == 0) return false;

            // Users must be activated
            if ($user->activated != 1) return false;


            ///////////////////////////////////////////////////////////////////
            // General ///////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////

            // Account
            $authority->allow('manage', 'Account', function ($self, $user)
            {
                if ($user)
                {
                    // user() is a shortcut for getCurrentUser()
                    return $self->user()->id === $user->id;
                }

                return true;
            });


            ///////////////////////////////////////////////////////////////////
            // Role Based ////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////

            // All
            if ($user->hasRole('admin')) {

                $authority->allow('manage', 'all', function ($self, $user)
                {
                    if ($user)
                    {
                        foreach($user->roles as $role)
                        {
                            // Don't allow admins to manage other admins
                            if ($self->getCurrentUser()->id !== $user->id && $role->name === 'admin') return false;
                        }   
                    }

                    return true;
                });

                $authority->deny('delete', 'Users', function ($self, $user)
                {
                    if ($user)
                    {
                        foreach($user->roles as $role)
                        {
                            // Don't allow admins to delete other admins
                            if ($role->name === 'admin') return true;
                        }    

                        // Don't allow admins to delete themselves
                        return $self->getCurrentUser()->id === $user->id;
                    }
                    
                    return true;
                });
            }


            ///////////////////////////////////////////////////////////////////
            // User Based ////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////

            // loop through each of the user's permissions, and create rules
            foreach($user->permissions as $perm)
            {
                if($perm->type == 'allow')
                {
                    $authority->allow($perm->action, $perm->resource);
                } else {
                    $authority->deny($perm->action, $perm->resource);
                }
            }
        }
    }

);