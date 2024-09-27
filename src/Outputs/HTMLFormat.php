<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class HTMLFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        $output = '<style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                margin: 0;
                padding: 0;
                background: #f4f4f4;
                color: #333;
            }
            header {
                background: #2980b9;
                color: #fff;
                padding: 10px 20px;
                text-align: center;
            }
            nav {
                margin: 10px 0;
            }
            nav a {
                color: #fff;
                margin: 0 15px;
                text-decoration: none;
            }
            h1, h2, h3 {
                color: #2c3e50;
            }
            h1 {
                border-bottom: 2px solid #2980b9;
                padding-bottom: 10px;
            }
            p {
                margin: 10px 0;
            }
            ul {
                list-style-type: square;
                padding-left: 20px;
            }
            .container {
                max-width: 800px;
                margin: auto;
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            .banner {
                text-align: center;
                margin-bottom: 20px;
            }
            .banner img {
                max-width: 100%;
                height: auto;
                border-radius: 8px;
            }
        </style>';

        $output .= '<header>';
        $output .= '<h1>School Profile</h1>';
        $output .= '<nav><a href="#">Home</a><a href="#">About Us</a><a href="#">Programs</a><a href="#">Contact</a></nav>';
        $output .= '</header>';

        $output .= '<div class="banner">';
        $output .= '<img src="https://www.auf.edu.ph/home/images/articles/bya.jpg" alt="School Image">';
        $output .= '</div>';

        $output .= '<div class="container">';
        $output .= "<h2>Profile of " . htmlspecialchars($profile->getFullName()) . "</h2>";
        $output .= "<p>Date of Birth: " . htmlspecialchars($profile->getDateOfBirth()) . "</p>";
        $output .= "<h3>Birth Event</h3>";
        $output .= "<p>" . htmlspecialchars($profile->getBirthEvent()) . "</p>";

        $education = $profile->getEducationalBackground();
        $output .= "<h3>Educational Background</h3>";
        $output .= "<p>" . htmlspecialchars($education['degree']) . " from " . htmlspecialchars($education['high_school']) . " (Graduated: " . htmlspecialchars($education['graduation_year']) . ")</p>";

        $family = $profile->getFamily();
        $output .= "<h3>Family</h3>";
        $output .= "<p>Brother: " . htmlspecialchars($family['brother']['name']) . " (" . htmlspecialchars($family['brother']['role']) . ")</p>";

        $output .= "<h3>Key Events</h3><ul>";
        foreach ($profile->getKeyEvents() as $event) {
            $output .= "<li>" . htmlspecialchars($event['event']) . " on " . htmlspecialchars($event['date']) . " at " . htmlspecialchars($event['location']) . "</li>";
        }
        $output .= "</ul>";

        $output .= "<h3>Philanthropy</h3>";
        $output .= "<p>" . htmlspecialchars($profile->getPhilanthropy() ?? 'No philanthropy information available.') . "</p>";

        $output .= "<h3>Story Highlights</h3>";
        foreach ($profile->getStory() as $section => $content) {
            $output .= "<h4>" . ucfirst(str_replace('_', ' ', $section)) . "</h4>";
            $output .= "<p>" . htmlspecialchars($content) . "</p>";
        }
        $output .= '</div>';

        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text/html');
        return $this->response;
    }
}
