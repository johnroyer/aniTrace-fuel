<?php

class Model_Track extends \Orm\Model_Soft
{
   protected static $_soft_delete = array(
      'deleted_field' => 'delete_at',
   );

   protected static $_properties = array(
      'id',
      'user_id' => array(
         'validation' => array('required'),
      ),
      'name' => array(
         'default' => '',
      ),
      'sub' => array(
         'default' => '',
      ),
      'volumn' => array(
         'default' => 0,
      ),
      'download' => array(
         'default' => 0,
      ),
      'link' => array(
         'default' => '',
      ),
      'finished' => array(
         'default' => 0,
      ),
      'public' => array(
         'default' => 0,
      ),
      'update_at',
      'delete_at' => array(
        'default' => null,
      ),
   );

   protected static $_observers = array(
      'Orm\Observer_CreatedAt' => array(
         'events' => array('before_insert'),
         'mysql_timestamp' => false,
         'property' => 'update_at',
      ),
      'Orm\Observer_UpdatedAt' => array(
         'events' => array('before_update'),
         'mysql_timestamp' => false,
         'property' => 'update_at',
      ),
   );
   protected static $_table_name = 'tracks';

}
