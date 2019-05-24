<?php
class EventsManager extends Model
{
    public function getEvents()
    {
        return $this->getAllEvents('events', 'events');
    }
}