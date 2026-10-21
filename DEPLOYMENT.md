# Adam Studio on Render

Deployment is prepared, but no Render resources have been created yet.

This Blueprint runs the custom theme with WordPress/PHP 8.3 and a private
MySQL 8.4 service in Frankfurt. Both services and their disks incur charges;
review Render's current cost estimate before creating them.

## Publish

1. Push this folder to a GitHub or GitLab repository. `.gitignore` excludes
   the local WordPress test installation, database, configuration, and the
   theme's self-referencing symlink.
2. Connect the repository to a new Render Blueprint using `render.yaml`.
3. Set `WORDPRESS_ADMIN_EMAIL` to your administrator email and review the
   service cost estimate before deploying.
4. Wait for both services to become healthy. Open the web service's assigned
   `https://…onrender.com` URL.
5. Sign in at `/wp-admin/` as `studio-admin`, using the generated
   `WORDPRESS_ADMIN_PASSWORD` from the web service's Render environment.
   Change the password in WordPress after signing in. The bootstrap password
   is used only on initial installation; it never resets an existing password.

## Content and persistence

The local `wp-test` database is shared with unrelated Cephas and Stellayedia
projects. It is deliberately excluded from this clean deployment. The theme's
existing initializer creates its bundled pages, projects, services and team.
Local admin accounts, leads, Elementor templates and uploaded media are not
migrated. Any custom content migration needs a separate, scoped export.

The theme has native page, header and footer templates and works without
Elementor. Elementor can be installed in WordPress if its editor is needed;
Elementor Pro requires your own license and plugin upload.

MySQL persists on its own disk; plugins, uploads and other WordPress content
persist on the web service's disk. Theme files are refreshed from the image
on each deployment, so edit the theme in the source repository. WordPress
core comes from the Docker image; rebuild to incorporate upstream updates.
Database backups should use MySQL-aware exports, not just disk snapshots.

The official WordPress image handles HTTPS forwarding from Render. For a
custom domain, set `WORDPRESS_SITE_URL` to its canonical HTTPS URL and perform
a backed-up WordPress URL search/replace for previously saved content.

Contact submissions are stored by the theme. Outbound WordPress email still
needs a mail provider/SMTP configuration for reliable delivery on Render.

## Validation

Validated the Blueprint against Render's published JSON schema. Shell syntax
and all theme/bootstrap PHP syntax checks passed. Docker is not installed in
this workspace, so the image build, database bootstrap, persistence, and public
routes must still be verified during deployment.

References: https://render.com/docs/deploy-wordpress and
https://render.com/docs/blueprint-spec.
