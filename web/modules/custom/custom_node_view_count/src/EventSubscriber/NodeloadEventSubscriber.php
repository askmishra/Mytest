<?php 

namespace Drupal\custom_node_view_count\EventSubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\hook_event_dispatcher\HookEventDispatcherInterface;


class NodeloadEventSubscriber implements EventSubscriberInterface{
	public static function getSubscribedEvents(){
		return [HookEventDispatcherInterface::ENTITY_VIEW=>"hookNodeLoad"];
	}

public function hookNodeLoad($event){
  
  if ($event->getEntity()->getEntityTypeId() == 'node') {
  		$allowed_content_types = ['article'];
    if(in_array($event->getEntity()->getType(), $allowed_content_types)) { 
    		
		$visitors = $event->getEntity()->get('field_visitors')->value + 1;
		$event->getEntity()->set('field_visitors',$visitors);
		$event->getEntity()->save();

		$nid = $event->getEntity()->id();
		$node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
		$type_name = $node->type->entity->label();
		
			//print_r('by');
			$visitors = $node->get('field_visitors')->value + 1;
			$node->field_visitors = $visitors;
			$node->setPublished(TRUE);
			$node->setChangedTime($node->getChangedTime());
			//	$node->set('moderation_state', "published");
			$node->setNewRevision(FALSE);
			$node->doNotForceNewRevision = TRUE;
			$node->save();
  	}
  	
  }
  

}


}
?>