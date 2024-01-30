<?php

function encrypt_data($data)
{
    $publickey=file_get_contents(asset_url().'files/public.pem');
    $isvalid = openssl_public_encrypt ($data, $crypted , $publickey,OPENSSL_PKCS1_PADDING);    
    $crypted=base64_encode($crypted);
    return $crypted;
}

function decrypt_data($data)
{
    $privatekey=file_get_contents(asset_url().'files/private.key');
    openssl_private_decrypt (base64_decode($data), $decrypted , $privatekey,OPENSSL_PKCS1_PADDING);    
    return  $decrypted;
}


function debug($ele=array())
{
    echo "<pre>";
    print_r($ele);
    $data=debug_backtrace();
    echo '<br>File Name =>'.$data[0]['file'];
    echo '<br>Line No   =>'.$data[0]['line'];
    echo "<br>";
}

function getFilterCond($filter)
{
        $response=array('start_date'=>'','end_date'=>'');
        if($filter=="all")
        {
            $start_date='';
            $end_date='';
            $month_names = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
            $x_axis=implode(",",$month_names);

        }
        if($filter=='year')
        {
                $start_date=strtotime(date('Y-m-d',strtotime("first day of january this year")).' 00:00:00');
                $end_date=strtotime(date('Y-m-d',strtotime("last day of december this year")).' 23:59:59');
         
            
            for ($i=0; $i <10 ; $i++) { 
               $year[]= date("Y",strtotime("+".$i." year"));
            }
            $x_axis=implode(",",$year);
             
        }
        elseif($filter=='month')
        {

         $start_date = date('Y-m-d',strtotime('first day of this month'));
         $end_date = date('Y-m-d',strtotime('last day of this month'));

         $start_date = strtotime($start_date. '00:00:00');
         $end_date = strtotime($end_date. '23:59:59');

         $month_names = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
         $x_axis=implode(",",$month_names);

        }
        elseif($filter=="week")
        {
            $start_date = date('Y-m-d', strtotime("sunday -1 week"));

            $start_date = strtotime($start_date. '00:00:00');
            $end_date=date('Y-m-d',strtotime("Saturday This Week"));
            $end_date = strtotime($end_date. '23:59:59');

            $wk = array("Sun","Mon","Tue","Wed","Thi","Fri","Sat");
            $x_axis=implode(',',$wk);

          
        }
        elseif($filter=="day")
        {
            
            $start_date=date('Y-m-d');
            $start_date=strtotime($start_date. '00:00:00');
            $end_date = strtotime(date('Y-m-d'). '23:59:59');
            
            $transdate = date('Y-m-d');
            $month = date('m', strtotime($transdate));
            $year = date('Y', strtotime($transdate));
            $startdate = "01-".$month."-".$year;
            $starttime = strtotime($startdate);

            $endtime = strtotime("+1 month", $starttime);

            for($i=$starttime; $i<$endtime; $i+=86400)
            {
            $x[] = date('d-M-y', $i);
            }

            $x_axis=implode(",",$x);


            // $x_axis=implode(",",$list);         
        }
        else
        {
            $start_date="";
            $end_date="";
            $x_axis="";
        }

        $response = array('start_date' =>$start_date ,'end_date'=>$end_date,'x_axis'=>$x_axis );

        return $response;
}



?>