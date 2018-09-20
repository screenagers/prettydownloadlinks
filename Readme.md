# Pretty Download Links

Creates recursive filelist of any given directory and outputs as responsive HTML table.

Option to copy download links with one click.

## Setup
- Copy everything into a web-accessible directory on your webserver.
- Open index.php and adapt $config options

```$config = array(
  'index_path' => './uploads/',
  'base_url' => 'https://your-download-site.example/uploads/',
  'display_limit' => 20,
);
```

Put all your files your `index_path` directory. Make sure they are accessible by pointing your browser to `base_url` and the filename.

### Security

If you do not want the whole world to access your files, put a password on your `base_url` with .htaccess or similar.

## Options
Create a new directoryFiles Instance.

`new directoryFiles(index_path, base_url, recursive)`

- `index_path`: path to directory that should be indexed
- `base_url`: base URL for generating the download links
- `recursive`: boolean to indicate if you want to scan subdirectories also (default = TRUE)

## Browser Support
Modern browsers and Internet Explorer 11+.

## Sponsors
- [screenagers](https://www.screenagers.com)
- [brandquiz](https://www.brandquiz.io)

## Links
- [Website](https://github.com/screenagers)

## LICENSE
[MIT](LICENSE)
