<?php
    // 4.3.1 (Nomor 1)
    // fungsi validateName, digunakan untuk validasi surname dengan format alfabet
    function validateName($field_list, $field_name)
    {
        if (!isset($field_list[$field_name]))
            return false;
        $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
        if (!preg_match($pattern, $field_list[$field_name]))
            return false;
        return true;
    }

    // 4.3.1 (Nomor 4)
    // fungsi validateNameArray (penamaan diubah agar tidak sama)
    function validateNameArray(&$error, $field_list, $field_name) {
        $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
        if (empty($field_list[$field_name])) {
            $error["surname"] = "Tidak boleh kosong";
            return false;
        } else if (!preg_match($pattern, $field_list[$field_name])) {
            $error["surname"] = "Tidak boleh ada selain alfabet , ', -";
            return false;
        }
        return true;
    }
?>