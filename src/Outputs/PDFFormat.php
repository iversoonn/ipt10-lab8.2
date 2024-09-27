<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;
use Fpdf\Fpdf;

class PDFFormat implements ProfileFormatter
{
    private $pdf;

    public function setData($profile)
    {
        $this->pdf = new Fpdf();
        $this->pdf->AddPage();

        $this->pdf->Image('https://www.auf.edu.ph/home/images/articles/bya.jpg', 90, 10, 30);
        $this->pdf->Ln(50); 
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->Cell(0, 10, 'Full Name ' . $profile->getFullName(), 0, 1,);

        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(0, 10, 'Date of Birth: ' . $profile->getDateOfBirth(), 0, 1);
        $this->pdf->Cell(0, 10, 'Birth Event: ' . $profile->getBirthEvent(), 0, 1);
        
        // Education
        $education = $profile->getEducationalBackground();
        $this->pdf->Cell(0, 10, 'Education: ' . $education['degree'] . ' at ' . $education['high_school'] . ' (Graduated in ' . $education['graduation_year'] . ')', 0, 1);
        
        // Family
        $family = $profile->getFamily();
        $this->pdf->Cell(0, 10, 'Family: Brother - ' . $family['brother']['name'] . ' (' . $family['brother']['role'] . ')', 0, 1);
        
        // Key Events
        $this->pdf->Cell(0, 10, 'Key Events:', 0, 1);
        foreach ($profile->getKeyEvents() as $event) {
            $this->pdf->Cell(0, 10, '- ' . $event['event'] . ' on ' . $event['date'] . ' in ' . $event['location'], 0, 1);
        }

        // Philanthropy
        $this->pdf->Cell(0, 10, 'Philanthropy: ' . $profile->getPhilanthropy(), 0, 1);

        // Story Highlights
        $this->pdf->Cell(0, 10, 'Story Highlights:', 0, 1);
        foreach ($profile->getStory() as $section => $content) {
            $this->pdf->Cell(0, 10, ucfirst(str_replace('_', ' ', $section)) . ': ' . $content, 0, 1);
        }
    }

    public function render()
    {
        return $this->pdf->Output();
    }
}
