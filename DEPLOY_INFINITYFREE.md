# How to Deploy Laravel Todo App to InfinityFree

This guide will walk you through deploying your Laravel application to InfinityFree hosting.

## Prerequisites

1.  **InfinityFree Account**: Sign up at [InfinityFree.net](https://infinityfree.net).
2.  **Domain/Subdomain**: Create a subdomain (e.g., `mytodoapp.rf.gd`) in your account.
3.  **FTP Client**: Download and install [FileZilla](https://filezilla-project.org/) (recommended) or use the "Online File Manager" in InfinityFree.

## Step 1: Prepare Your Project for Deployment

Before uploading, we need to optimize the project and exclude unnecessary files.

1.  **Run Build Commands locally**:
    Open your terminal in the project folder and run:

    ```bash
    composer install --optimize-autoloader --no-dev
    npm run build
    ```

    _(This ensures all dependencies are ready and assets are compiled.)_

2.  **Configure Environment**:
    - Rename `.env.example` to `.env` (if you haven't already).
    - Set `APP_DEBUG=false` for production.
    - Set `APP_URL=http://your-domain.rf.gd`.

3.  **Zip Your Project**:
    Compress all files in your project folder into a `.zip` file, **EXCEPT**:
    - `node_modules` folder (huge and not needed).
    - `.git` folder (if exists).
    - `tests` folder (optional).

## Step 2: Upload Files to InfinityFree

1.  **Access File Manager**:
    Log in to InfinityFree -> "Control Panel" -> "Online File Manager" (or use FTP credentials from the "FTP Details" section).

2.  **Upload the Zip**:
    - Navigate to the `htdocs` folder.
    - Delete the default `index2.html` or `default.php` if present.
    - Upload your `.zip` file.
    - **Extract** the zip file contents directly into `htdocs`.
    - **Important**: Your file structure inside `htdocs` should look like this:
        ```
        htdocs/
        ├── app/
        ├── bootstrap/
        ├── config/
        ├── public/
        ├── ... other folders
        ├── .env
        ├── artisan
        └── ...
        ```

3.  **Set Up Redirection**:
    Since InfinityFree serves from `htdocs` but Laravel expects to be served from `public`, create a new file named `.htaccess` in the **root of `htdocs`** (not inside `public`) with the following content:

    ```apache
    <IfModule mod_rewrite.c>
      RewriteEngine On
      RewriteRule ^(.*)$ public/$1 [L]
    </IfModule>
    ```

## Step 3: Configure Database

1.  **Create Database**:
    - Go to InfinityFree Control Panel -> "MySQL Databases".
    - Create a new database (e.g., `epiz_3456789_todo`).
    - Note down the:
        - **MySQL Host Name** (e.g., `sql123.infinityfree.com`)
        - **MySQL User Name** (e.g., `epiz_3456789`)
        - **MySQL Password** (your vPanel password)
        - **MySQL Database Name**

2.  **Import Database**:
    - Export your local database to a `.sql` file using your local tool (phpMyAdmin, TablePlus, etc.).
    - Go to InfinityFree Control Panel -> "phpMyAdmin".
    - Select your new database.
    - Click "Import" and upload your `.sql` file.

3.  **Update Configuration**:
    - Edit the `.env` file in your `htdocs` folder on InfinityFree.
    - Update the database details:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=sql123.infinityfree.com  <-- YOUR HOST from step 3.1
        DB_PORT=3306
        DB_DATABASE=epiz_3456789_todo    <-- YOUR DB NAME
        DB_USERNAME=epiz_3456789         <-- YOUR USERNAME
        DB_PASSWORD=your_vpanel_password <-- YOUR PASSWORD
        ```

## Step 4: Final Checks

1.  **Generate App Key**:
    If your `.env` file on the server has an empty `APP_KEY`, you can copy the one from your local `.env` file or generate a new one locally (`php artisan key:generate --show`) and paste it there.

2.  **Visit Your Site**:
    Open your domain (e.g., `http://mytodoapp.rf.gd`) in a browser. You should see your Laravel Todo App!

## Troubleshooting

### 1. Fixing 500 Error (Permission Issues)

This is the most common error. It means Laravel can't write to its log or cache folders.

**Important:** The "Online File Manager" on InfinityFree usually **DOES NOT** allow changing permissions (the option is missing or disabled). You must use one of the methods below.

#### Method 1: Using the provided script (Easiest)

I have included a file called `fix_permissions.php` in your `project.zip`.

1.  Upload `project.zip` and extract it as usual.
2.  Make sure `fix_permissions.php` is in your `htdocs` folder.
3.  Visit `http://your-domain.rf.gd/fix_permissions.php` in your browser.
4.  It will attempt to fix the permissions for you.
5.  **Delete the file** afterwards for security.

#### Method 2: Using FileZilla (Recommended & Reliable)

If Method 1 doesn't work, you must use an FTP client.

1.  Download and install [FileZilla Client](https://filezilla-project.org/).
2.  Open FileZilla and connect using your FTP details (Host, Username, Password, Port 21).
3.  Navigate to `/htdocs`.
4.  Right-click on the `storage` folder.
5.  Select **File permissions...**.
6.  Type **777** in the "Numeric value" box.
7.  Check **Recurse into subdirectories**.
8.  Select **Apply to all files and directories**.
9.  Click **OK**.
10. Repeat steps 4-9 for the `bootstrap/cache` folder.

### 2. Other Issues

- **CSS/JS Missing**: Ensure you ran `npm run build` locally before uploading and that the `public/build` folder exists on the server.
