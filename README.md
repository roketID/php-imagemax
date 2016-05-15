# php-imagemax
PHP helper to make life easier with ImageMax(TM) image convertion

### use case
Helper :
```` php
// Configuration
$config = [
  'canonical' => '<YOUR CANONICAL NAME>',
  'baseurl' => '<YOUR BASE URL>',
  'profiles' => [
    'thumb' => [
      'w' => 128, // width
      'h' => 128, // height
      'q' => 8, // quality
      'fm' => 'jpg', // format
      'bri' => -10, // brightness
    ],
    'medium' => '500x300-imxq-8-imxbri--10', // w = 500; h = 300; q = 8; bri = -10
    'large' => '800x600', // w = 800; h = 600 
  ],
];

// Initial
ImageMax::init($config);

// Get thumbnail URL
ImageMax::make('files/my_picture.jpg', 'thumb');

// with different format, mention it in third parameter
ImageMax::make('files/my_picture.jpg', 'thumb', 'png');

// Get image directly from options array
ImageMax::make('files/my_picture.jpg', [
  'w' => 128, // width
  'h' => 128, // height
  'q' => 8, // quality
  'fm' => 'jpg', // format
  'bri' => -10, // brightness
]);

// Get image from absolute URL
ImageMax::make('https://my.base.url/files/my_picture.jpg', 'thumb');

