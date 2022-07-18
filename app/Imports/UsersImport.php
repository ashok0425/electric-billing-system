<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Hash;
class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $name=explode(' ',$row[0]);
        if($row[0]!=null){
            return new User([
                'name'     => $row[0],
               'email'    => $row[0].rand(1,100).'@gmail.com', 
               'password' => Hash::make($name[0].'900'),
            ]);
        }
     
    }
}
