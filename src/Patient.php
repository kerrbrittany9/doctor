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
    }
?>
