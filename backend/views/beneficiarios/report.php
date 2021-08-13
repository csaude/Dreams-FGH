
<?php

    header( "Content-Type: application/excel; Charset: utf-8" ); 
    header( "Content-Disposition: attachment; filename=report.xls" );
    header('Cache-Control: max-age=0');
    $i=0;
    $map = array();

    $map[$i++] = $period;
    $map[$i++] = $province;
    $map[$i++] = $district;
    $i++; // skip total field

    //first desagregation
    $firstDesagregationTotal = 0;
    foreach(['0_6','7_12', '13_24', '25+'] as $index2){
        $sum = 0;
        foreach(['9-14','15-19', '20-24', '25-29'] as $index1){ 
            $sum += $firstDesagregation[$index1][$index2];
            $map[$i++] = $firstDesagregation[$index1][$index2];
        }
        $map[$i++] = $sum;
        $firstDesagregationTotal += $sum;
    };
    

    //second desagregation
    foreach(['0_6','7_12', '13_24', '25+'] as $index2){
        $sum = 0;
        foreach(['9-14','15-19', '20-24', '25-29'] as $index1){  
            $sum += $secondDesagregation[$index1][$index2];
            $map[$i++] = $secondDesagregation[$index1][$index2];
        }
        $map[$i++] = $sum;
        $firstDesagregationTotal += $sum;
    };

    //third desagregation
   foreach(['0_6','7_12', '13_24', '25+'] as $index2){
        $sum = 0;
        foreach(['9-14','15-19', '20-24', '25-29'] as $index1){  
            $sum += $thirdDesagregation[$index1][$index2];
            $map[$i++] = $thirdDesagregation[$index1][$index2];
        }
        $map[$i++] = $sum;
        $firstDesagregationTotal += $sum;
    };

    //fourth desagregation
    foreach(['0_6','7_12', '13_24', '25+'] as $index2){
        $sum = 0;
        foreach(['9-14','15-19', '20-24', '25-29'] as $index1){  
            $sum += $fourthdesagregationResults[$index1][$index2];
            $map[$i++] = $fourthdesagregationResults[$index1][$index2];
        }
        $map[$i++] = $sum;
        $firstDesagregationTotal += $sum;
    };

    //violence
    $sum = 0;
    foreach(['0_6','7_12', '13_24', '25+'] as $index2){
        
        foreach(['9-14','15-19', '20-24', '25-29'] as $index1){  
            $sum += $fifthdesagregationResults[$index1][$index2];
        }
    };
    $map[$i++] = $sum;
    // $firstDesagregationTotal += $sum;

    //education
    $sum = 0;
    foreach(['0_6','7_12', '13_24', '25+'] as $index2){
        
        foreach(['9-14','15-19', '20-24', '25-29'] as $index1){  
            $sum += $sixthdesagregationResults[$index1][$index2];
        }
    };
    $map[$i++] = $sum;
    // $firstDesagregationTotal += $sum;
    $map[3] = $firstDesagregationTotal;



    $data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
                <head>
                    <!--[if gte mso 9]>
                    <xml>
                        <x:ExcelWorkbook>
                            <x:ExcelWorksheets>
                                <x:ExcelWorksheet>
                                    <x:Name>Sheet 1</x:Name>
                                    <x:WorksheetOptions>
                                        <x:Print>
                                            <x:ValidPrinterInfo/>
                                        </x:Print>
                                    </x:WorksheetOptions>
                                </x:ExcelWorksheet>
                            </x:ExcelWorksheets>
                        </x:ExcelWorkbook>
                    </xml>
                    <![endif]-->

                    <style>
                    
                        .test{
                            background-color:red;
                        }
                    </style>
                </head>

                <body>
                    <table style="width:100%">
                        <tbody>
                        <tr>
                            <th rowspan="5">Reporting_Period</th>
                            <th rowspan="5">Province</th>
                            <th rowspan="5">District</th>
                            <th colspan="80">AGYW_PREV (Denominator) : Number of active DREAMS beneficiaries that have started or completed any DREAMS service/intervention</th>
                        </tr>
                        <tr>
                            <td rowspan="4">Total</td>
                            <td colspan="20">Beneficiaries that have fully completed the DREAMS primary package of services/interventions but no additional services/interventions</td>
                            <td colspan="20">Beneficiaries that have fully completed the DREAMS primary package of services/interventions AND at least one secondary service/intervention</td>
                            <td colspan="20">Beneficiaries that have completed at least one DREAMS service/intervention but not the full primary package</td>
                            <td colspan="20">Beneficiaries that have started a DREAMS service/intervention but have not yet completed it</td>
                            <td rowspan="4">Violence Prevention Service Type</td>
                            <td rowspan="4">Education Support Service Type</td>
                            <td rowspan="4">Data Check</td>
                        </tr>
                        <tr>
                    
                            <td colspan="20">Enrollment Time / Age</td>
                        </tr>
                        <tr>
                            <td colspan="5">0-6</td>
                            <td colspan="5">7-12</td>
                            <td colspan="5">13-24</td>
                            <td colspan="5">25+ months</td>
                            <td colspan="5">0-6</td>
                            <td colspan="5">7-12</td>
                            <td colspan="5">13-24</td>
                            <td colspan="5">25+ months</td>
                            <td colspan="5">0-6</td>
                            <td colspan="5">7-12</td>
                            <td colspan="5">13-24</td>
                            <td colspan="5">25+ months</td>
                            <td colspan="5">0-6</td>
                            <td colspan="5">7-12</td>
                            <td colspan="5">13-24</td>
                            <td colspan="5">25+ months</td>
                        </tr>
                        <tr>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            <td>9-14</td>
                            <td>15-19</td>
                            <td>20-24</td>
                            <td>25-29</td>
                            <td>SubTotal</td>
                            
                        </tr>';
    $data .='<tr>'; 
    for($j = 0; $j < $i; $j++){
        $data .='<td>'.$map[$j].'</td>';    
    }  
    $data .='<tr/>';                   

/*
    $data .='<tr><td>'.$period.'</td>';    
    $data .='<td>'.$province.'</td>';     
    $data .='<td>'.$district.'</td>';               
       
    //first desagregation
    $firstDesagregationTotal = 0;
    $data .='<td>'. 0 .'</td>';    //desagregation total
    foreach(['0_6','7_12', '13_24', '25+'] as $index2){
        $sum = 0;
        foreach(['9-14','15-19', '20-24', '25-29'] as $index1){
            $data .='<td>'.$firstDesagregation[$index1][$index2].'</td>';  
            $sum += $firstDesagregation[$index1][$index2];
        }
        $data .='<td>'.$sum.'</td>'; // desagregation subtotal

    };
 
    $data .='</tr>';  
*/


        
                    $data .= ' </tbody>
                    </table>
                </body>
            </html>';    



    echo $data;
    exit;
?>