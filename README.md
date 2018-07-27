# vc_search_api
REST API to search in version control public repos, application built using Slim and domain model architecture 
### Expected Environment  
  
* Composer  
  
### Installation  
  
1- Clone this repository:  
```bash  
$ git clone https://github.com/remonfci/vc_search_api.git
```  
2- cd into the project folder the run Composer install  
```bash  
$ composer install  
```  


### Usage  
  
* Send a get request to the service's URL  

```bash
 http://localhost:8080/api/repositories?q=class+in:file+language:js+repo:jquery/jquery&page_count=5&page=1&sort=stars
```  
