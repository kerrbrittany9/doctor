<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Doctor.php";
    require_once "src/Patient.php";

    $server = 'mysql:host=localhost:8889;dbname=doctor_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DoctorTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Doctor::deleteAll();
          Patient::deleteAll();
        }

        function testGetName()
        {
            //Arrange
            $name = "Calla Rudolph, M.D.";
            $specialty = "Heart Surgeon";
            $test_doctor = new Doctor($name, $specialty);

            //Act
            $result = $test_doctor->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testGetSpecialty()
        {
            //Arrange
            $name = "Calla Rudolph, M.D.";
            $specialty = "Heart Surgeon";
            $test_specialty = new Doctor($name, $specialty);

            //Act
            $result = $test_specialty->getSpecialty();

            //Assert
            $this->assertEquals($specialty, $result);
        }

        function testSave()
        {
           //Arrange
           $name = "Calla Rudolph, M.D.";
           $specialty = "Heart Surgeon";
           $test_doctor = new Doctor($name, $specialty);

           //Act
           $executed = $test_doctor->save();

           // Assert
           $this->assertTrue($executed, "Doctor not successfully saved to database");
         }

       function testGetId()
       {
            //Arrange
            $name = "Calla Rudolph, M.D.";
            $specialty = "Heart Surgeon";
            $test_doctor = new Doctor($name, $specialty);
            $test_doctor->save();

            //Act
            $result = $test_doctor->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }


        function testGetAll()
        {
            //Arrange
            $name = "Calla Rudolph, M.D.";
            $specialty = "Heart Surgeon";
            $name_2 = "Lar Bear, D.O";
            $specialty_2 = "Nose Surgeon";
            $test_doctor = new Doctor($name, $specialty);
            $test_doctor->save();
            $test_doctor_2 = new Doctor($name_2, $specialty_2);
            $test_doctor_2->save();

            //Act
            $result = Doctor::getAll();

            //Assert
            $this->assertEquals([$test_doctor, $test_doctor_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Calla Rudolph, M.D.";
            $specialty = "Heart Surgeon";
            $name_2 = "Lar Bear, D.O";
            $specialty_2 = "Nose Surgeon";
            $test_doctor = new Doctor($name, $specialty);
            $test_doctor->save();
            $test_doctor_2 = new Doctor($name_2, $specialty_2);
            $test_doctor_2->save();

            //Act
            Doctor::deleteAll();
            $result = Doctor::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

    }

?>
