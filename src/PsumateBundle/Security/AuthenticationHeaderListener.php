<?php 
namespace PsumateBundle\Security;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
class AuthenticationHeaderListener
{   
    public function onKernelRequest(GetResponseEvent $event)
    {  
        $this->fixAuthHeader($event->getRequest()->headers);
        // Don't do anything if it's not the master request.
        
        $request = $event->getRequest();
        $method  = $request->getRealMethod();
        #echo $request->headers->get('origin').":::::::::::::".$request->getMethod();
        #if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
        #    return;
        #}
        // perform preflight checks
        
        if ('OPTIONS' === $request->getMethod()) {
             #echo $request->headers->get('origin').":::::::::::::";
            $response = new Response();
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
            $response->headers->set('Access-Control-Max-Age', 3600);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $event->setResponse($response);
            return;
        }else{
            #$response = new Response();
            #$response->headers->set('Access-Control-Allow-Origin', $this->cors);
            #$event->setResponse($response);
            header('Access-Control-Allow-Origin: *');
        }    
          
    }
    public function onKernelResponse(FilterResponseEvent $event)
    {   
        //$this->fixAuthHeader($event->getRequest()->headers);
        $request = $event->getRequest();
        #echo $request->headers->get('origin').":::::::::::::";
        //die($request->headers->get('origin'));
        // Run CORS check in here to ensure domain is in the system
        #if (in_array($request->headers->get('origin'), $this->cors)) {
            $response = $event->getResponse();
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
            $response->headers->set('Access-Control-Allow-Origin', $request->headers->get('origin'));
            $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS');
            $response->headers->set('Vary', 'Origin');
            $event->setResponse($response);
       # }else{
            #$response = $event->getResponse();
            #$response->headers->set('Access-Control-Allow-Origin', $this->cors);
            #$event->setResponse($response);
            #header('Access-Control-Allow-Origin: *');
        #}
        return;
        
    }
    /**
     * PHP does not include HTTP_AUTHORIZATION in the $_SERVER array, so this header is missing.
     * We retrieve it from apache_request_headers()
     *
     * @param HeaderBag $headers
     */
    protected function fixAuthHeader(HeaderBag $headers)
    {
        if (!$headers->has('Authorization') && function_exists('apache_request_headers')) {
            $all = apache_request_headers();
            if (isset($all['Authorization'])) {
                $headers->set('Authorization', $all['Authorization']);
            }
        }
    }
}