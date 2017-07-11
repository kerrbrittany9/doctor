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
        protected function tearDown()
        {
            Patient::deleteAll();
            Doctor::deleteAll();
        }

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

        function testGetDoctorID()
        {
            //Arrange
            $name = "Calla Rudolph";
            $specialty = "Heart Surgeon";
            $test_doctor = new Doctor($name, $specialty);
            $test_doctor->save();

            $doctor_id = $test_doctor->getId();
            $patient_name = "Brittany Kerr";
            $dob = "May 14";
            $test_patient = new Patient($patient_name, $dob, $doctor_id);
            $test_patient->save();

            //Act
            $result = $test_patient->getDoctorId();

            //Assert
            $this->assertEquals($doctor_id, $result);
        }

        function testSave()
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

            //Act
            $executed = $test_patient->save();

            //Assert
            $this->assertTrue($executed, "Patient not successfully saved to database");
        }

        function testGetAll()
      {
          //Arrange
          $name = "Calla Rudolph";
          $specialty = "Heart Surgeon";
          $test_doctor = new Doctor($name, $specialty);
          $test_doctor->save();
          $doctor_id = $test_doctor->getId();

          $patient_name = "Brittany Kerr";
          $dob = "May 14";
          $test_patient = new Patient($patient_name, $dob, $doctor_id);
          $test_patient->save();

          $patient_name_2 = "Maxo Baxo";
          $dob_2 = "Christmas";
          $test_patient_2 = new Patient($patient_name_2, $dob_2, $doctor_id);
          $test_patient_2->save();

          //Act
          $result = Patient::getAll();

          //Assert
          $this->assertEquals([$test_patient, $test_patient_2], $result);
      }

      function testDeleteAll()
      {
          //Arrange
          $name = "Calla Rudolph";
          $specialty = "Heart Surgeon";
          $test_doctor = new Doctor($name, $specialty);
          $test_doctor->save();
          $doctor_id = $test_doctor->getId();

          $patient_name = "Brittany Kerr";
          $dob = "May 14";
          $test_patient = new Patient($patient_name, $dob, $doctor_id);
          $test_patient->save();

          $patient_name_2 = "Maxo Baxo";
          $dob_2 = "Christmas";
          $test_patient_2 = new Patient($patient_name_2, $dob_2, $doctor_id);
          $test_patient_2->save();

          //Act
          Patient::deleteAll();

          //Assert
          $result = Patient::getAll();
          $this->assertEquals([], $result);
      }

    }
?>
