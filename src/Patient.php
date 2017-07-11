<?php
    class Patient
    {
        private $patient_name;
        private $dob;
        private $doctor_id;
        private $id;

        function __construct($patient_name, $dob, $doctor_id, $id = null)
        {
            $this->patient_name = $patient_name;
            $this->dob = $dob;
            $this->doctor_id = $doctor_id;
            $this->id = $id;
        }

        function setPatientName($new_patient_name)
        {
            $this->patient_name = (string) $new_patient_name;
        }

        function getPatientName()
        {
            return $this->patient_name;
        }

        function setDob($new_dob)
        {
            $this->dob = (string) $new_dob;
        }

        function getDob()
        {
            return $this->dob;
        }

        function getDoctorId()
        {
          return $this->doctor_id;
        }

        function getID()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO patients (name, birthday, doctor_id) VALUES ('{$this->getPatientName()}', '{$this->getDob()}', {$this->getDoctorId()})");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertID();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $returned_patients = $GLOBALS['DB']->query("SELECT * FROM patients;");
            $patients = array();
            foreach($returned_patients as $patient) {
                $patient_name = $patient['name'];
                $patient_dob = $patient['birthday'];
                $doctor_id = $patient['doctor_id'];
                $patient_id = $patient['id'];
                $new_patient = new Patient($patient_name, $patient_dob, $doctor_id, $patient_id);
                array_push($patients, $new_patient);
            }
            return $patients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM patients;");
        }
    }
?>
