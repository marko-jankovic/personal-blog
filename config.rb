# Require any additional compass plugins here.

# Set this to the root of your project when deployed:
http_path = "/"
css_dir = "web/bundles/admin/css"
sass_dir = "web/bundles/admin/css/sass"
images_dir = "web/bundles/admin/img"
javascripts_dir = "web/bundles/admin/js"

output_style = :compressed
environment = :production
output_style = :expanded
environment = :development
sass_options = { :debug_info => true }

# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true



# If you prefer the indented syntax, you might want to regenerate this
# project again passing --syntax sass, or you can uncomment this:
preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass css/sass scss && rm -rf sass && mv scss sass
#additional_import_paths = ["src/Blog/AdminBundle/Resources/public/css/sass"]

sprite_load_path = ["web/admin/blogadmin/img"]