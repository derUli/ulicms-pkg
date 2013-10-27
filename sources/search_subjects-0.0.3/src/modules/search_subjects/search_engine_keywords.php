<?php

// Function returns the query string (q or query parameters) from the referrer
function get_search_query()
{
    $ref_keywords = '';
 
    // Get the referrer to the page
    $referrer = $_SERVER['HTTP_REFERER'];
    
    if(strpos($referrer, php_uname('n')) !== false)
       return $ref_keywords;

    if (!empty($referrer))
    {
        //Parse the referrer URL
        $parts_url = parse_url($referrer);
 
        // Check if a query string exists
        $query = isset($parts_url['query']) ? $parts_url['query'] : '';
        if($query)
        {
            // Convert the query string into array
            parse_str($query, $parts_query);
            // Check if the parameters 'q' or 'query' exists, and if exists that is our search query terms.
            $ref_keywords = isset($parts_query['q']) ? $parts_query['q'] : (isset($parts_query['query']) ? $parts_query['query'] : '' );
        }
    }
    return $ref_keywords;
}
