<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Patient.php";
    require_once "src/Doctor.php";

    $server = 'mysql:host=localhost:8889;dbname=doctor_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PatientTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Patient::deleteAll();
        //     Doctor::deleteAll();
        // }

        function testGetID()
        {
            //Arrange
            $name = "Calla Rudolph";
            $specialty = "Heart Surgeon";
            $test_doctor = new Doctor($name, $specialty);
            $test_doctor->save();

            $patient_name = "Brittany Kerr";
            $dob = "May 14";
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($patient_name, $dob, $doctor_id);
            $test_patient->save();

            //Acts
            $result = $test_patient->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
    }
?>
