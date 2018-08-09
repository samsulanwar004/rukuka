<?php

if( ! function_exists('unique_random') ){
    /**
     *
     * Generate a unique random string of characters
     * uses str_random() helper for generating the random string
     *
     * @param     $table - name of the table
     * @param     $col - name of the column that needs to be tested
     * @param int $chars - length of the random string
     *
     * @return string
     */
    function unique_random($table, $col, $chars = 16){

        $unique = false;

        // Store tested results in array to not test them again
        $tested = [];

        do{

            // Generate random string of characters
            $random = str_random($chars);

            // Check if it's already testing
            // If so, don't query the database again
            if( in_array($random, $tested) ){
                continue;
            }

            // Check if it is unique in the database
            $count = DB::table($table)->where($col, '=', $random)->count();

            // Store the random character in the tested array
            // To keep track which ones are already tested
            $tested[] = $random;

            // String appears to be unique
            if( $count == 0){
                // Set unique to true to break the loop
                $unique = true;
            }

            // If unique is still false at this point
            // it will just repeat all the steps until
            // it has generated a random string of characters

        }
        while(!$unique);


        return $random;
    }

} 

if (! function_exists('elixirCDN')) {
    function elixirCDN($file) {
        $cdn = '';

        if(env('CDN_URL', false))
        {
            $cdn = env('CDN_URL');
        }

        return $cdn . elixir($file);
    }
}

if (! function_exists('imageCDN')) {
    function imageCDN($file) {
        $cdn = '';

        if(env('S3_URL', false))
        {
            $cdn = env('S3_URL');
        }

        return $cdn .'/images/'.$file;
    }
}

if (! function_exists('uploadCDN')) {
    function uploadCDN($file) {
        $cdn = '';

        if(env('S3_URL', false))
        {
            $cdn = env('S3_URL');
        }

        $link = $file == null ? '#' : $cdn.'/'.$file;

        return $link;
    }
}

if (! function_exists('actionLink')) {
    function actionLink(array $param = null, array $remove = null) {
        $query = request()->query();

        for ($i=0; $i < count($remove); $i++) { 
            unset($query[$remove[$i]]);
        }

        if ($query) {
            $param = isset($param) ? mergeArrays($query, $param) : $query;
        }
        
        if(is_array($param)) {
            return '?'.http_build_query($param);
        } else {
            return null;
        }
        
    }
}

if (! function_exists('mergeArrays')) {
    function mergeArrays($Arr1, $Arr2)
    {
      foreach($Arr2 as $key => $Value)
      {
        if(array_key_exists($key, $Arr1) && is_array($Value))
          $Arr1[$key] = MergeArrays($Arr1[$key], $Arr2[$key]);

        else
          $Arr1[$key] = $Value;

      }

      return $Arr1;

    }
}