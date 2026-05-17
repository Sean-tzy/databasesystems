<?php
ob_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../controllers/clinicstaff.controller.php';
require_once __DIR__ . '/../models/clinicstaff.model.php';

class ClinicStaffList {

    public function printStaffList() {

        $clinic_staff = (new ControllerClinicStaff)->ctrClinicStaffList();

        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 15, 10);
        $pdf->AddPage('L');

        // =========================
        // HEADER DESIGN
        // =========================
        $html = '
        <div style="text-align:center;">
            <h2 style="margin:0;">LABTRIX CLINIC SYSTEM</h2>
            <h4 style="margin:0;">Clinic Staff Report</h4>
            <small>Generated on: '.date("F d, Y").'</small>
        </div>

        <br><br>

        <table border="1" cellpadding="5">
            <thead>
                <tr style="background-color:#2c3e50; color:#ffffff; font-weight:bold;">
                    <th width="60">ID</th>
                    <th width="140">First Name</th>
                    <th width="40">MI</th>
                    <th width="140">Last Name</th>
                    <th width="150">Designation</th>
                    <th width="110">PRC</th>
                    <th width="120">Mobile</th>
                </tr>
            </thead>
            <tbody>
        ';

        $rowColor = 0;

        foreach ($clinic_staff as $value) {

            $bg = ($rowColor % 2 == 0) ? '#f9f9f9' : '#ffffff';

            $html .= '
                <tr style="background-color:'.$bg.';">
                    <td width="60">'.($value["empid"] ?? '').'</td>
                    <td width="140">'.($value["firstname"] ?? '').'</td>
                    <td width="40">'.($value["mi"] ?? '').'</td>
                    <td width="140">'.($value["lastname"] ?? '').'</td>
                    <td width="150">'.($value["designation"] ?? '').'</td>
                    <td width="110">'.($value["prc"] ?? '').'</td>
                    <td width="120">'.($value["mobile"] ?? '').'</td>
                </tr>
            ';

            $rowColor++;
        }

        $html .= '
            </tbody>
        </table>

        <br><br>

        <div style="text-align:right;">
            <small>Page '.$pdf->getAliasNumPage().'</small>
        </div>
        ';

        ob_end_clean();

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('clinicstaff.pdf', 'I');
    }
}

$staff_list = new ClinicStaffList();
$staff_list->printStaffList();