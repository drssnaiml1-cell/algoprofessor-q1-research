<?php
// AlgoProfessor visitor counter. Upload beside index.html on cPanel.
// Counts one visit per browser every 30 days (cookie) and keeps a daily tally.
header('Content-Type: application/json');
header('Cache-Control: no-store');

$file = __DIR__ . '/visits.json';
$fp = fopen($file, 'c+');
if (!$fp) { http_response_code(500); echo '{"error":"storage"}'; exit; }
flock($fp, LOCK_EX);
$raw = stream_get_contents($fp);
$d = json_decode($raw ?: '', true);
if (!is_array($d)) $d = ['total' => 0, 'days' => []];

date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
if (empty($_COOKIE['ap_v'])) {
  $d['total']++;
  $d['days'][$today] = ($d['days'][$today] ?? 0) + 1;
  setcookie('ap_v', '1', ['expires' => time() + 86400 * 30, 'path' => '/', 'secure' => true, 'httponly' => true, 'samesite' => 'Lax']);
}
// keep the last 60 days only
krsort($d['days']);
$d['days'] = array_slice($d['days'], 0, 60, true);

ftruncate($fp, 0);
rewind($fp);
fwrite($fp, json_encode($d));
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);

$month = 0;
foreach ($d['days'] as $day => $n) { if ($day >= date('Y-m-d', strtotime('-29 days'))) $month += $n; }
echo json_encode(['total' => $d['total'], 'today' => $d['days'][$today] ?? 0, 'month' => $month]);
