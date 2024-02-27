
<?php

function call_logger($errorlog){
    $isActive = true;
    if($isActive){
        $newfile = 	'public/errorlog/Debuglog_'.date('dmy').'.txt';

        $exists = Storage::disk('local')->exists($newfile);
        if(!$exists)
        {
            Storage::put($newfile, '');
        }
    
        $logfile=fopen(Storage::path($newfile),'a');
        
        $ip = \Request::ip();
        date_default_timezone_set('Asia/Kolkata');
        $time = date('d-m-Y h:i:s A',time());
        $contents = "$ip\t$time\t$errorlog\r";
        fwrite($logfile,$contents);
        
    }	
}

function getName($tableName,$id){
    $name = DB::table($tableName)->where('id',$id)->get('Name');
    if($name->isNotEmpty()){
        return $name[0]->Name;
    }
    
}

function getColumnValue($tableName,$where,$val,$columnName){
    $value = DB::table($tableName)->where($where,$val)->get($columnName);
    if($value->isNotEmpty()){
        return $value[0]->$columnName;
    }
}


?>