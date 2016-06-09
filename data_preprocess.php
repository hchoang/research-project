<?php
$csv = array_map('str_getcsv', file('review.csv'));
array_walk($csv, function(&$a) use ($csv) {
    $a = array_combine($csv[0], $a);
});
array_shift($csv);
$reviewData = array();
foreach ($csv as $row) {
    $row['Review Date'] = transformDate($row['Review Date']);
    if (!$row['Reviewer Name']) {
        $row['Reviewer Name'] = 'John Doe ' . rand();
    }
    $reviewData[] = $row;
}

function transformDate($date) {
    $date = preg_replace('/\\b(\d+)(?:st|nd|rd|th)\\b/', '$1', $date);
    $date = preg_replace('/\\b(of)\\b/', '', $date);
    $date = preg_replace('/  /', ' ' , $date);
    $date = preg_replace('/\\b(January|February|March|April|May|June|July|August|September|October|November|December),/', '$1', $date);
    $date = preg_replace('/\\b(January|February|March|April|May|June|July|August|September|October|November|December) (\\d{2}):(\\d{2})/', '$1 2015 $2:$3', $date);
    if (preg_match('/\b\d day(s?) ago/', $date, $output)) {
        $dateAgo = date('d M Y', strtotime("-$output[0]", strtotime('31 August 2015')));
        $date = str_replace($output[0], $dateAgo, $date);
    }
    return $date;
}

function fillMissingUser($user) {

}

function pearsonCorrelationCalculation(array $firstRow, array $secondRow)
{
    stats_stat_correlation($firstRow, $secondRow);

}