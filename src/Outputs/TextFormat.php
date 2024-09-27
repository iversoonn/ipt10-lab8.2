<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class TextFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = "Full Name: " . $profile->getFullName() . PHP_EOL;
        $output .= "Date of Birth: " . $profile->getDateOfBirth() . PHP_EOL;
        $output .= "Birth Event: " . $profile->getBirthEvent() . PHP_EOL;

        $education = $profile->getEducationalBackground();
        $output .= "Education: " . $education['degree'] . " at " . $education['high_school'] . " (Graduated in " . $education['graduation_year'] . ")" . PHP_EOL;

        $family = $profile->getFamily();
        $output .= "Family: Brother - " . $family['brother']['name'] . " (" . $family['brother']['role'] . ")" . PHP_EOL;

        $output .= "Key Events:\n";
        foreach ($profile->getKeyEvents() as $event) {
            $output .= "- " . $event['event'] . " on " . $event['date'] . " in " . $event['location'] . PHP_EOL;
        }

        $output .= "Philanthropy: " . $profile->getPhilanthropy() . PHP_EOL;

        $output .= "Story Highlights:\n";
        foreach ($profile->getStory() as $section => $content) {
            $output .= ucfirst(str_replace('_', ' ', $section)) . ": " . $content . PHP_EOL;
        }

        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text/plain');
        return $this->response;
    }
}
