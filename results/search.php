<?php

include_once "./autoload.php";

//get values from result search form
if ( isset( $_POST['result'] ) ) {
    $exam  = $_POST['exam'];
    $year  = $_POST['year'];
    $board = $_POST['board'];
    $roll  = $_POST['roll'];
    $reg   = $_POST['reg'];

// From validation
    if ( empty( $exam ) || empty( $year ) || empty( $board ) || empty( $roll ) || empty( $reg ) ) {

        header( "location:./" );

    } else {
        //Printing student results on the result page
        $result = connect()->query( "SELECT * FROM students WHERE education = '$exam' AND board = '$board' AND year = '$year' AND roll = '$roll' AND reg = '$reg' LIMIT 1" );

// Check if the data exist or not
        if ( mysqli_num_rows( $result ) > 0 ) {
            $search_data = $result->fetch_object();
        } else {
            header( "location:./?error=No Results Found" );
        }

    }

} else {
    header( "location:./" );
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Education Board Bangladesh</title>
    <link rel="stylesheet" href="assets/css/syle.css">

    <link rel="shortcut icon" type="image/x-icon" href="assets/images/bd_logo.png">
</head>

<body>

    <div class="wraper">

        <div class="w-top">
            <div class="logo">
                <img src="assets/images/bd_logo.png" alt="">
            </div>
            <div class="banner">
                <h3>Ministry of Education</h3>
                <hr>
                <h4>Intermediate and Secondary Education Boards Bangladesh</h4>
            </div>
        </div>
        <div class="w-main">


            <div class="student-info">
                <div class="student-photo">
                    <img src="../photos/<?php echo $search_data->photo; ?>" alt="">
                </div>
                <div class="student-details">
                    <table>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $search_data->name; ?></td>
                        </tr>
                        <tr>
                            <td>Roll</td>
                            <td><?php echo $search_data->roll; ?></td>
                        </tr>
                        <tr>
                            <td>Reg.</td>
                            <td><?php echo $search_data->reg; ?></td>
                        </tr>
                        <tr>
                            <td>Board</td>
                            <td><?php echo strtoupper( $search_data->board ); ?></td>
                        </tr>
                        <tr>
                            <td>Result</td>
                            <td><?php echo result( $search_data->bn, $search_data->en, $search_data->math, $search_data->sc, $search_data->ssc, $search_data->reli ); ?>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>

            <div class="student-result">
                <table>
                    <tr>
                        <td>Subject</td>
                        <td>Marks</td>
                        <td>Grade</td>
                        <td>GPA</td>
                        <td>CGPA</td>
                    </tr>
                    <tr>
                        <td>Bangla</td>
                        <td><?php echo $search_data->bn; ?></td>
                        <td><?php echo grade( $search_data->bn ); ?></td>
                        <td><?php echo gpa( $search_data->bn ); ?></td>
                        <td rowspan="6">
                            <?php echo cgpa( $search_data->bn, $search_data->en, $search_data->math, $search_data->sc, $search_data->ssc, $search_data->reli ); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>English</td>
                        <td><?php echo $search_data->en; ?></td>
                        <td><?php echo grade( $search_data->en ); ?></td>
                        <td><?php echo gpa( $search_data->en ); ?></td>
                    </tr>
                    <tr>
                        <td>Math</td>
                        <td><?php echo $search_data->math; ?></td>
                        <td><?php echo grade( $search_data->math ); ?></td>
                        <td><?php echo gpa( $search_data->math ); ?></td>
                    </tr>
                    <tr>
                        <td>Science</td>
                        <td><?php echo $search_data->sc; ?></td>
                        <td><?php echo grade( $search_data->sc ); ?></td>
                        <td><?php echo gpa( $search_data->sc ); ?></td>
                    </tr>
                    <tr>
                        <td>Social Science</td>
                        <td><?php echo $search_data->ssc; ?></td>
                        <td><?php echo grade( $search_data->ssc ); ?></td>
                        <td><?php echo gpa( $search_data->ssc ); ?></td>
                    </tr>
                    <tr>
                        <td>Religion</td>
                        <td><?php echo $search_data->reli; ?></td>
                        <td><?php echo grade( $search_data->reli ); ?></td>
                        <td><?php echo gpa( $search_data->reli ); ?></td>
                    </tr>
                </table>
            </div>




        </div>
        <div class="w-footer">
            <div class="f-left">
                <p>©2005-2022 Ministry of Education, All rights reserved.</p>
            </div>
            <div class="f-right">
                <span>Powered by</span>
                <img src="assets/images/tbl_logo.png" alt="">
            </div>
        </div>
    </div>
    <div class="bottom">
        <img src="assets/images/play.png" alt="">
    </div>




</body>

</html>