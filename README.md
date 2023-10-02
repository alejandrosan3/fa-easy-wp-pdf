# Frantic Ape's Easy PDF to WordPress Plugin

`FA EasyPDF` is a WordPress plugin designed to make PDF generation from a WordPress pag, seamless. With custom templates and optimized performance, the plugin provides a robust solution for WordPress sites that require PDF functionalities.

## Table of Contents

- [Installation (Production)](#installation-production)
- [Development](#development)
  - [Prerequisites](#prerequisites)
  - [Getting Started](#getting-started)
  - [Using Gulp for Build Processes](#using-gulp-for-build-processes)
  - [Template System](#template-system)
- [Support](#support)

## Installation (Production)

1. Download the latest release of the `fa-easypdf.zip` plugin from the releases page.
2. Navigate to your WordPress dashboard.
3. Go to `Plugins > Add New`.
4. Click on the `Upload Plugin` button.
5. Choose the `fa-easypdf.zip` file you downloaded earlier and click `Install Now`.
6. After the installation is complete, click `Activate Plugin`.
7. Navigate to the plugin's settings page to configure according to your preferences.

## Development

### Prerequisites

- Node.js (latest stable version)
- Gulp CLI
- A local WordPress environment (e.g., Local by Flywheel)

### Getting Started

1. Clone the repository to your local machine.
2. Navigate to the plugin directory.
3. Run `npm install` to install all the required dependencies.
4. Make changes to the plugin files as required.

### Using Gulp for Build Processes

Gulp tasks are set up to help with various build processes, including minifying CSS and JS, optimizing images, and packaging the plugin for distribution.

To run all tasks:

```
gulp
```

To run specific tasks:

```
gulp [task-name]
```

e.g: `gulp minify-css`

## Template System

The plugin comes with a built-in template system that allows you to override default plugin views:

- Create a folder named faeasypdf in your theme or child theme.
- Copy the content from the plugin's templates folder into the faeasypdf folder you just created.
- Modify these templates as needed. The plugin will prioritize the templates in the theme over its own.

## Support

For support, issues, or feature requests, please open a new issue on our GitHub repository or open a support forum ticket on WordPress.org
