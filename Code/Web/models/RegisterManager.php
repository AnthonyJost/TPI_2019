<?php
class RegisterManager extends Model
{
    public function getSchools()
    {
        return $this->getAllSchools('schools', 'schools');
    }
}