<?php
try {
$queries = isset($_POST['queries']) ? $_POST['queries'] : '';

if (!empty($queries)) {
# set up the request parameters
$queryString = http_build_query([
    'api_key' => 'demo',
    'q' => $_POST['queries'],
    'location' => 'India,Greater London,England,United Kingdom',
    'page' => '2',
    'num' => '10'
  ]);
  
  # make the http GET request to VALUE SERP
  $ch = curl_init(sprintf('%s?%s', 'https://api.valueserp.com/search', $queryString));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_TIMEOUT, 180);
  
  $api_result = curl_exec($ch);
  curl_close($ch);

  # print the JSON response from VALUE SERP
  $results1 =json_decode($api_result);
  $result_data =$results1->request_info->success;
  if (!empty($result_data)) {
  $results =$results1->organic_results;
   foreach ($results as $item) {
    $structuredResults[] = [
        'title'  => $item->title??'',
        'link'   => $item->link??'',
        'snippet'=> $item->snippet??'',
    ];   
}
}
else{
    
}

}
} catch (Exception $e) {
    // Handle the exception
    echo $e->getMessage();
}
?>
<?php if(!empty($structuredResults)){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    <title>Table</title>
</head>
<body>

<h2>Search Data</h2>
<input type="text" id="search-input" placeholder="Search by Title">
<button id="export-btn">Export to CSV</button>
<table id="data-table">
    <thead>
        <tr>
                <th>Title</th>
                <th>LINK</th>
                <th>Snippet</th>
                
        </tr>
    </thead>
    <tbody>
      <?php foreach($structuredResults as $val){ ?>
        <tr>
            <td><?php echo $val['title']; ?></td>
            <td><?php echo $val['link']; ?></td>
            <td><?php echo $val['snippet']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
   
</body>
</html>
<?php }else{ ?>
    <h1>No Result Found</h1>
<?php }?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Search input keyup event
        $('#search-input').keyup(function() {
            var searchTerm = $(this).val().toLowerCase();
            
            // Filter table rows based on search term
            $('#data-table tbody tr').each(function() {
                var name = $(this).find('td:first-child').text().toLowerCase();

                if (name.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Export button click event
        $('#export-btn').click(function() {
            var csvContent = 'data:text/csv;charset=utf-8,';
            csvContent += 'Name,Age,City\n';

            // Iterate through visible rows and add to CSV content
            $('#data-table tbody tr:visible').each(function() {
                var rowData = [];
                $(this).find('td').each(function() {
                    rowData.push('"' + $(this).text() + '"');
                });
                csvContent += rowData.join(',') + '\n';
            });

            // Create a data URI and trigger download
            var encodedURI = encodeURI(csvContent);
            var link = document.createElement('a');
            link.setAttribute('href', encodedURI);
            link.setAttribute('download', 'exported_data.csv');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });
</script>   