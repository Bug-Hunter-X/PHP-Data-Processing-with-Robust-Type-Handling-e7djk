```php
function processData(array $data): array {
  // Check if the array is empty
  if (empty($data)) {
    return []; // Return an empty array if input is empty
  }

  // Process the data
  $processedData = [];
  foreach ($data as $item) {
    // Assume each item is an array with a 'value' key
    if (isset($item['value'])) {
      // Handle potential type errors
      if (is_numeric($item['value'])) {
          $processedData[] = (int)$item['value']; // Cast to int if numeric
      } else if (is_string($item['value'])) {
          $processedData[] = $item['value'];
      } else {
        // Handle unsupported data types appropriately
          //Maybe log error, skip item, or throw an exception 
          error_log('Unsupported data type encountered: ' . gettype($item['value']));
      }
    }
  }

  return $processedData;
}

// Example usage
$data = [
  ['value' => 10],
  ['value' => 'hello'],
  ['value' => 20.5],
  ['value' => true], //Bug: This will trigger the error handling
  ['value' => ['nested']], //Bug: This will also trigger the error handling
];

$processedData = processData($data);
print_r($processedData);
```