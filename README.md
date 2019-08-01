# Hash Resource Finder

This package for Flow and Neos helps linking and embedding CSS and JavaScript resource files that have a hash in their filename.

It is recommended to use this package with Webpack. The following filename format is accepted: `[name].[hash].[ext]`
The helper looks (with PHPs glob function) for a given filename pattern, but it can only find one file! So you need to set up your Webpack config in a way that it clears the output folder before building the file.

## Basics

All output files must be saved in `Resources/Public/Compiled`. Any other folders are not available at the moment.

Example for a file structure:

```
- Resources/Public/Compiled
    - app.42ef132c667d635cd64c.js
    - style.ec1c0f2da1613bbf27cb75f92ae5bf8a.css
```

If your file structure looks like this, you can use `app.js` as well as `style.css` as filename patterns for this package.
The helper class will return the first file that matches the pattern without the hash.

## Use in Fusion

### CSS-Link Tag


