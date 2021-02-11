# Compress image size

**ImageCompressor** - this is an easy way to compress images on the fly.

There are following methods:

* sourceFile - takes the path to the file to be compressed. Returns an ImageCompressor object. (requred)
* setOptions - takes an array of parameters that you want to pass to the library for compression. (optional)
* compress - takes a file path to save after compression. Returns the boolean value of the execution result. If a save
  path was not passed, the file that was passed in the "sourceFile" method will be compressed directly. (optional)

# Requirements

The following libraries need to be installed:

### Jpegoptim

```
sudo apt-get -y install jpegoptim
```

### Pngquant

```
sudo apt-get -y install pngquant
```

# Installation

## Composer

Execute the following command to install this package as a dependency in your project:

```
composer require tihiy-production/php-image-compressor
```

## Usage example

```php
ImageCompressor::sourceFile('test.jpg')->compress('test_compressed.jpg');
```

with *setOptions* method

### PNG

```php
ImageCompressor::sourceFile('test.png')
    ->setOptions([
        '--force',
        '--skip-if-larger',
        '--quality 85'
    ])
    ->compress('test_compressed.png');
```

### JPEG

```php
ImageCompressor::sourceFile('test.jpg')
    ->setOptions([
        '--force',
        '--strip-all',
        '-m85'
    ])
    ->compress('test_compressed.jpg');
```

The entire list of available options you can get by entering the terminal "pngquant -h" and "jpegoptim -h" accordingly.

