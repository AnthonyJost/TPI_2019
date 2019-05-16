<?php
class EventsManager extends Model
{
    public function getEvents()
    {
        return $this->getAll('events', 'events');
    }
}