# Webdevs Blog


## Setup 

- homebrew (http://brew.sh/) **$ brew install wget**

- xampp server, php verzija 5.5 (http://www.apachefriends.org/en/xampp-macosx.html ) - ovo je old, pitati igora za novi

- **MySQL** 
				
		$ brew install mysql
		
		
	- If you have MySQL installed through Homebrew these commands will help you:

		- For starting launchctl load ~/Library/LaunchAgents/homebrew.mxcl.mysql.plist

	 	- For stoping launchctl unload ~/Library/LaunchAgents/homebrew.mxcl.mysql.plist

		- /usr/local/bin/mysql.server restart


- **Sequel Pro** database management application (www.sequelpro.com/ )

- **Composer** iz konzole *$ curl -s getcomposer.org/installer | php -d detect_unicode=Off*

- **Download** Symfony2 (http://symfony.com/download)
			
		$ mkdir webdevsblog
		$ cd webdevsblog
		$ composer create-project symfony/framework-standard-edition
	
- **General Setups**
		
		- php.ini		(php -i | grep php.ini) /usr/local/etc/php/5.5/php.ini (date.timezone)

		- host		/private/etc/hosts (dodavanje novog domena)

		- httpd-vhosts.conf		/private/etc/apache2/extra (dodavanje putanje do projekta)

		- httpd.conf 			/private/etc/apache2/httpd.conf (DocumentRoot, Directory)

		- subl .bash_profile

		- restart apach-a (sudo apachectl restart)

		 - get ip address - ifconfig
 
		 - sudo chmod -R 777 /Users/markojankovic/workspace
		
		 - git config --global core.filemode false
		 
		 - If this does not work you are probably using a newer version of git so try the 
		 
			- git config --add --global core.filemode false		 

- enable twig debuging

		services:
		    debug.twig.extension:
		        class: Twig_Extensions_Extension_Debug
		        tags: [{ name: 'twig.extension' }]
		        
- enable twig text extension (config.yml)
	
		services:
			debug.twig.text:
            	class: Twig_Extensions_Extension_Text
	            tags: [{ name: 'twig.extension' }]
	            
- in every twig template we access to variable **app**

	- app.security - The security context.
	
    - app.user - The current user object.
    	
	- app.request - The request object.
	    
	- app.session - The session object.
    	
	- app.environment - The current environment (dev, prod, etc).
	    
    - app.debug - True if in debug mode. False otherwise.



- #####Creating Bundle
		
	- *php app/console generate:bundle --namespace=Blog/AdminBundle --format=yml*
		

	- **Bundle name [BlogAdminBundle]:**

			The bundle can be generated anywhere. The suggested default directory uses the standard conventions.
			
			
	- **Target directory [/Users/markojankovic/workspace/private/webdevsblog/src]**
		
			To help you get started faster, the command can generate some code snippets for you.
			
	- **Do you confirm generation [yes]? yes**
	
			You are going to generate a "Blog\AdminBundle\BlogAdminBundle" bundle in "/Users/markojankovic/workspace/private/webdevsblog/src/" using the "yml" format.

	- **Confirm automatic update of your Kernel [yes]?**
			
			Generating the bundle code: OK
			Checking that the bundle is autoloaded: OK
			Enabling the bundle inside the Kernel: OK
			
	- **Confirm automatic update of the Routing [yes]?**
			
			Importing the bundle routing resource: OK
			
			
- #####Clearing Cache 

	- $ php app/console cache:clear
	
	- $ php app/console cache:clear --env=prod --no-debug
	

- #####Change config_dev.yml
	
	- twig:
		
		- cache: false
	    
	    - debug: true

	- services:
		
		- debug.twig.extension:
        
        	- class: Twig_Extensions_Debug
        
        	- tags: - { name: 'twig.extension' }
	
	
- #####Template layout

	- {% extends '::base.html.twig' %} {% endblock %}
	- path: app/Resource/views
	
	
- #####Creating Resource/public symlink into web folder	

	- *$ php app/console assets:install web --symlink*
	
	- activate symlink in composer.json 
			
			"extra": {
				"symfony-assets-install": "web"
			}
	
	- **example** {{ asset('bundles/blogadmin/css/style.css') }}
	
	
- #####Creating database
	- *$ php app/console doctrine:database:create*
			
			Created database for connection named `webdevsblog`
			
	- *$ php app/console doctrine:generate:entity*
	
			Updating database schema...
			Database schema updated successfully! "1" queries were executed
			
	- *$ php app/console doctrine:schema:update --force*
	
	
	**To see a query that will be run**
	- *$ php app/console doctrine:schema:update --dump-sql*
	
	
	
	
	- #####Creating Post and Author entity
	
	- *$ php app/console generate:doctrine:entity*

			BlogAdminBundle:Post
			
			BlogAdminBundle:Author
			
	- Created TimeStamp abstract class (@ORM\MappedSuperclass)
	
	- Author can have **N **posts 
	
			@ORM\OneToMany(targetEntity="Post", mappedBy="author", cascade={"remove"}	
		
	- Post can have only one Author

			@ORM\ManyToOne(targetEntity="Author", inversedBy="posts")
		
			@ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
			
			
	- Updating doctrine entities
		
			$ php app/console generate:doctrine:entities BlogAdminBundle:Post
			
			$ php app/console generate:doctrine:entities BlogAdminBundle:Author
			
	- instaled *doctrine-migrations-bundle* (not sure why!!!)
	
	- instaled *doctrine-fixtures-bunle*
	
			- Creating test data which we can load in database and always have the set of data to work while develping
			
			- OrderFixtureInterface - to get rigth order fixture loading
			
			
	
	- instaled *stof/doctrine-extensions-bundle* (not sure why!!!) pravi seo title sa dash?
			
			# Doctrine Extensions Configuration
			stof_doctrine_extensions:
    			orm:
        			default:
            			timestampable: true
						sluggable: true
	
	- *$ php app/console doctrine:migrations:diff* 
	- *$ php app/console doctrine:fixtures:load -n*
	- *$ php app/console doctrine:migrations:migrate -n*
	
	
	- controller unit test
		
			- brew install phpunit
	
			- phpunit -c app
			
			
	- Comment entity
		
			adding relationship with comment in the post entity
			
			@ORM\OneToMany(targetEntity="Comment", mappedBy="posts", cascade={"remove"})
			
			creating fixture
			
	- Comment form
	
			$ php app/console generate:doctrine:form BlogAdminBundle:Comment
			
			method setDefaultOptions defines the entity that this form is base on
			method getName returns the unique neme for the form
			
			
			
   - generate:doctrine:crud
   
   - $ php app/console router:debug
   
   
=============================================================================================

###Updating Entity   

	- *$ php app/console generate:doctrine:entity:AdminBundle:Post*
	- *$ php app/console doctrine:schema:update --force
	- *$ php app/console doctrine:fixtures:load -n 
   

---------------------------------------------------------------------------------------------   
##Security   

####Authentication
	
- Check the user credentials using token 
- app/config/security **firewalls** (security checkpoint)
	

####Authorization

- Depending on the token or rule alow/deny user access to some content/page



#####User Roles

- IS_AUTHENTICATED_ANONYMOUSLY (everyone has this)

- IS_AUTHENTICATED_REMEMBERED (users with current valid session or have remember me cookie)

- IS_AUTHENTICATED_FULLY (Authenticated during current session)


- Login Form

    - Created email field and remaped in firewals -> form_login -> username_parameter: _email

         access_control:
            - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
            - { path: ^/settings/users, roles: ROLE_ADMIN }
            - { path: ^/settings, roles: ROLE_USER }
            - { path: ^/settings/users*, roles: ROLE_ADMIN }
            
    - {{ form_rest(form) }} - print all required hidden inputs such as token   
   
---------------------------------------------------------------------------------------------   
   
   
   - redirect na login posle profile 'delete account' 
   - profile update fix za ROLE_USER
   
   
   
   - zavriti crud za usera
   		pass, avatar, info
   	
   - zavriti crud za post
   		napraviti categories/tags, ubaciti editor
   		
   - napraviti reply na comment, uraditi security question
   		
   - napraviti form type za sve forme
   - napraviti Role entity
   - zavrsiti forgot
   
   ---------------------------------------------------------------------------------------------