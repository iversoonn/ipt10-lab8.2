<?php

namespace App;

class Profile
{
    private $name;
    private $dateOfBirth;
    private $birthEvent;
    private $educationalBackground;
    private $family;
    private $keyEvents = [];
    private $philanthropy;
    private $story = [];

    public function __construct($data = null)
    {
        // Map the data to the class properties
        if (isset($data['founder'])) {
            $founder = $data['founder'];

            $this->name = $founder['name'];
            $this->dateOfBirth = $founder['date_of_birth'];
            $this->birthEvent = $founder['birth_event'];
            $this->educationalBackground = $founder['educational_background'];
            $this->family = $founder['family'];
            $this->keyEvents = $founder['key_events'];
            $this->philanthropy = $founder['philanthropy'];

            if (isset($data['story'])) {
                $this->story = $data['story'];
            }
        }
    }

    public function getFullName()
    {
        return $this->name; // Assuming name is just a string now
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function getBirthEvent()
    {
        return $this->birthEvent;
    }

    public function getEducationalBackground()
    {
        return $this->educationalBackground;
    }

    public function getFamily()
    {
        return $this->family;
    }

    public function getKeyEvents()
    {
        return $this->keyEvents;
    }

    public function getPhilanthropy()
    {
        return $this->philanthropy;
    }

    public function getStory()
    {
        return $this->story;
    }
}
