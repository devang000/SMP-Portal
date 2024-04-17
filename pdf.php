<?php
session_start();


include './conn.php';

// $res = mysqli_query($conn, "SELECT * FROM residents WHERE username='$_SESSION[uname]'");
// $i = 1;
// $row = mysqli_fetch_assoc($res);
// //$sql= "SELECT * FROM project WHERE column_name = 'register_page'";
// //  echo $_SESSION['count'];
// // exit(0);

date_default_timezone_set("Asia/Calcutta");

require("./FPDF/fpdf.php");

//customer and invoice details
$info = [
    "customer" => "Devang Gohil",
    "Email-ID" => "gohildev555@gmail.com",
    "Contact No" => "+91 9724601266",
    "city" => "Rajkot-36001",
    "invoice_no" => "1000001",
    "invoice_date" => date("d/m/y"),
    "invoice_time" => date("h:m:s A"),
    "total_amt" => "Rs.2399/-"
];
//invoice Products
$products_info = [
    "name" => "Platinum Plan",
    "price" => "Rs.2399/-",
    "total" => "Rs.2399/-"
];

class PDF extends FPDF
{
    function Header()
    {
        // Set light grey background color
        $this->SetFillColor(255, 255, 255);
        $this->Rect(0, 0, $this->GetPageWidth(), 50, 'F');

        //Display Company Info
        $this->SetFont('Arial', 'B', 14);
        $this->Image("./img/SMP.png", 5, 10, 60);
        $this->SetFont('Arial', '', 11);

        //Display INVOICE text
        $this->SetY(15);
        $this->SetX(-60);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(50, 10, "Invoice Receipt", 0, 1);

        //Display Horizontal line
        //$this->SetY(10);
        $this->Line(0, 48, 210, 48);
    }


    function body($info, $products_info)
    {
        //Billing Details
        $this->SetY(50);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 10, "Bill To: ", 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->Cell(50, 7, "Devang Gohil", 0, 1);
        $this->Cell(50, 7, "gohildev555@gmail.com", 0, 1);
        $this->Cell(50, 7, "+91 9724601266", 0, 1);
        $this->Cell(50, 7, "Ahmedabad", 0, 1);

        //Display Invoice no
        $this->SetY(55);
        $this->SetX(-60);
        $this->Cell(50, 7, "Invoice No : " . $info["invoice_no"]);

        //Display Invoice date
        $this->SetY(63);
        $this->SetX(-60);
        $this->Cell(50, 7, "Invoice Date : " . $info["invoice_date"]);

        //Display Invoice date
        $this->SetY(71);
        $this->SetX(-60);
        $this->Cell(50, 7, "Invoice Time : " . $info["invoice_time"]);

        //Display Table headings
        $this->SetY(95);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80, 9, "Total Items", 1, 0);
        $this->Cell(40, 9, "PRICE", 1, 0, "C"); // Center alignment for PRICE column
        $this->Cell(30, 9, "Discount", 1, 0, "C");
        $this->Cell(40, 9, "TOTAL", 1, 1, "C"); // Center alignment for TOTAL column
        $this->SetFont('Arial', '', 12);

        //Display table product rows
        $this->SetY(104); // Adjusted Y position to ensure no overlap
        $this->SetX(10);
        $this->MultiCell(80, 9, "Platinum Plan", "LR"); // Center alignment for "Platinum Plan"

        $this->SetY(104); // Adjusted Y position to ensure no overlap
        $this->SetX(90); // Adjusted X position to align with the price column
        $this->MultiCell(40, 9, "Rs.2399/-",
            "LR",
            "C"
        ); // Center alignment for "Rs.2399/-"

        $this->SetY(104); // Adjusted Y position to ensure no overlap
        $this->SetX(130); // Adjusted X position to align with the quantity column
        $this->MultiCell(30, 9, "0", "LR", "C"); // Center alignment for "0"

        $this->SetY(104); // Adjusted Y position to ensure no overlap
        $this->SetX(160); // Adjusted X position to align with the total column
        $this->MultiCell(40, 9, "Rs.2399/-",
            "LR",
            "C"
        ); // Center alignment for "Rs.2399/-"


        //Display table empty rows
        for ($i = 0; $i < 12 - count($products_info); $i++) {
            $this->Cell(80, 9, "", "LR", 0);
            $this->Cell(40, 9, "", "R", 0, "C"); // Center alignment for PRICE column
            $this->Cell(30, 9, "", "R", 0, "C");
            $this->Cell(40, 9, "", "R", 1, "C"); // Center alignment for TOTAL column
        }
        //Display table total row
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(150, 9, "GRAND TOTAL", 1, 0, "R");
        $this->Cell(40, 9, "Rs.2399/-", 1, 1, "C"); // Center alignment for TOTAL column

        //Display amount in words
        $this->SetY(-75);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 9, "Mode of payment", 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 9, "online payment through Razorpay", 0, 1);
    }


    function Footer()
    {

        //set footer position
        $this->SetY(-75);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, "SMP | General Manager", 0, 1, "R");
        $this->Ln(15);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, "Authorized Signature", 0, 1, "R");
        $this->SetY(-20);
        $this->SetFont('Arial', '', 10);
        //Display Footer Text
        $this->Cell(0, 10, "This invoice genreted by SMP - Society Management Team | Maintanance team", 0, 1, "C");
        $this->Cell(0, 10, "Thank you for joining the SMP- Society Management Team", 0, 1, "C");
    }
}
//Create A4 Page with Portrait 

$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$pdf->body($info, $products_info);
$pdf->Close();
$pdf->Output();
