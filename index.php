<?php
function getRandomCowImageUrl() {
    $searchUrl = "https://duckduckgo.com/?q=cow&t=h_&iar=images&iax=images&ia=images";

    // Vraag eerst de HTML op
    $html = file_get_contents($searchUrl);

    // DuckDuckGo verbergt resultaten in JS; deze regex pakt alleen wat zichtbaar is
    preg_match_all('/"image":"(https:\\/\\/[^"]+)"/', $html, $matches);

    if (!empty($matches[1])) {
        $images = array_unique(array_map('stripslashes', $matches[1]));
        $random = array_rand($images);
        return $images[$random];
    } else {
        return "https://upload.wikimedia.org/wikipedia/commons/3/3a/Cow_female_black_white.jpg"; // fallback
    }
}

$imageUrl = getRandomCowImageUrl();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Random Koe van Internet 🐮</title>
  <style>
    body { text-align: center; font-family: sans-serif; padding: 40px; background-color: #fcfcfc; }
    img { max-width: 90%; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    button { margin-top: 20px; font-size: 16px; padding: 10px 20px; border-radius: 6px; border: none; background: #4caf50; color: white; cursor: pointer; }
  </style>
</head>
<body>
  <h1>🐮 Random Koe van het Internet</h1>
  <img src="<?php echo htmlspecialchars($imageUrl); ?>" alt="Random koe" />
  <br>
  <form method="get">
    <button type="submit">Nog een koe!</button>
  </form>
</body>
</html>
