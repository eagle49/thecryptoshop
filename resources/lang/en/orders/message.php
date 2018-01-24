<?php
/**
* Language file for Product error/success messages
*
*/

return array(
    
    'product_exists'              => 'Product already exists!',
    'product_not_found'           => 'Product [:id] does not exist.',
    'product_login_required'      => 'The login field is required',
    'product_password_required'   => 'The password is required.',
    'insufficient_permissions' => 'Insufficient Permissions.',
    'banned'              => 'banned',
    'suspended'             => 'suspended',

    'success' => array(
        'create'    => 'Product was successfully created.',
        'update'    => 'Product was successfully updated.',
        'delete'    => 'Product was successfully deleted.',
        'ban'       => 'Product was successfully banned.',
        'unban'     => 'Product was successfully unbanned.',
        'suspend'   => 'Product was successfully suspended.',
        'unsuspend' => 'Product was successfully unsuspended.',
        'restored'  => 'Product was successfully restored.',
        'accepted'  => 'Order was successfully accepted',
        'completed' => 'Order was successfully completed',
    ),

    'error' => array(
        'create'    => 'There was an issue creating the Product. Please try again.',
        'update'    => 'There was an issue updating the Product. Please try again.',
        'delete'    => 'There was an issue deleting the Product. Please try again.',
        'unsuspend' => 'There was an issue unsuspending the Product. Please try again.',
        'file_type_error'    => 'There was an issue with image uploading type. Please try again.'
    ),

);
