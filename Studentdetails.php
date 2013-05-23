<?php
$file=fopen("student.csv","r") or die("can't open");
read_file_get_All_values($file,$records);
function read_file_get_All_values(&$file,&$records)
{
while($record=fgetcsv($file))
{
$records[$record[0]]=array("name"=>$record[1],"tamil"=>$record[2],"english"=>$record[3],"maths"=>$record[4],"science"=>$record[5],"social"=>$record[6]);
}
return $records;
}
print_r($records);
print("\n1.Get your Result\n2.Overall Pass %\n3.Failed Students\n4.overall Pass % per Subject\n5.Add your Details.\n6.Exit\nEnter your option:\n");
fscanf(STDIN,"%d",$option_number);
if($option_number==1)
{
    print("Enter your Roll.No");
    fscanf(STDIN,"%d",$rollno);
    if(array_key_exists($rollno,$records))
    {
         $total=get_total_mark($rollno, $records);
         $avg=$total/4;
   print("\nName:".$records[$rollno]['name']);
   print("\nTamil:".$records[$rollno]['tamil']);
   print("\nEnglish:".$records[$rollno]['english']);
   print("\nMaths:".$records[$rollno]['maths']);
   print("\nScience:".$records[$rollno]['science']);
   print("\nSocial Science:".$records[$rollno]['social']);
   print("\nTotal:".$total);
   print("\nAverage".$avg);
       
                
    }
    
    
}
else if($option_number==2)
{
    //not working
    passed_students($records);

}
else if($option_number==3)
{
   //not working
    failed_students($records);    
}
else if($option_number==4)
{
    print("\nEnter your subject:");
    fscanf(STDIN,"%s",$subject);
 $number_of_pass=number_of_pass_per_subject($subject,$records); 
 $number_of_students=number_of_students($records);
 $pass_percent_subject=($number_of_pass/$number_of_students)*100;
 $pass_percent_subject=round($pass_percent_subject);
 print("\nNumber of students pass:". $number_of_pass);
 print("\nNumber of pass % in"." ".$subject."=".$pass_percent_subject."\n");
    
}
else if($option_number==5)
{
    //not finished
 Print("\nEnter Student Name:");
 fscanf(STDIN,"%s",$name);
 Print("\nEnter mark in Tamil :");
 fscanf(STDIN,"%d",$tamil);
 Print("\nEnter mark in English :");
 fscanf(STDIN,"%d",$english);
 Print("\nEnter mark in Maths :");
 fscanf(STDIN,"%d",$maths);
 Print("\nEnter mark in Science :");
 fscanf(STDIN,"%d",$science);
 Print("\nEnter mark in Social Science :");
 fscanf(STDIN,"%d",$social);
 create_rollno();
 add_new_student($rollno,$name,$tamil,$english,$maths,$science,$social);
}
else if($option_number==6)
{
 file_exit($file);   
}
    
function get_total_mark($number,$records)
{
$total=$records[$number]['tamil']+$records[$number]['english']+$records[$number]['maths']+$records[$number]['science']+$records[$number]['social'];
return $total;
}

function number_of_students($records)
{
    $number_of_students=count($records)-1;
    return $number_of_students;
   
}
function number_of_pass_per_subject(&$subject,$records)
{
 $pass=0;
for($i=1;$i<count($records);$i++)
{
if(35<=$records[$i][$subject])
{
 $name[]=$records[$i]['name'];
 $pass=$pass+1;
}

}
return $pass;
}
function file_exit($file)
{
    fclose($file);
    exit();
}

/*i expect display passed students name only,but it displayed all students name*/
    function passed_students($records)
    {
        for($i=1;$i<count($records);$i++)
        {
            if(35<=$records[$i]['tamil'] && $records[$i]['english'] && $records[$i]['maths'] && $records[$i]['science'] && $records[$i]['social'])
            {
             $name[]=$records[$i]['name'];  
            }   
        }
        //print_r($name);
       return $name;
    }
    /*i expect display failed students name only,but it displayed all students name*/
    function failed_students(&$records)
    {
        for($i=1;$i<count($records);$i++)
        {
            if(35 > $records[$i]['tamil'] || $records[$i]['english']|| $records[$i]['maths'] || $records[$i]['science'] || $records[$i]['social'])
            {
                $name[]=$records[$i]['name'];
                
            }
       
        }
        //print_r($name);
                return $name;
    }
    
    function create_rollno(&$rollno)
    {
    $rollno= range(4,9);
    return $rollno;
    }
   
//not finished 
function add_new_student($rollno,$name,$tamil,$english,$maths,$science,$social,&$records)
{
   
   $file=fopen("student.csv","w");
   $new_student=array('rollno'=>$rollno,'tamil'=>$name,'english'=>$tamil,'maths'=>$maths,'science'=>$sci,'social'=>$ssci); 
   $records=fputcsv($file,$new_student);
}

 


?>
