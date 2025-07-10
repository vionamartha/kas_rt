<?php  

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// Tambahan import model alert dan message
use App\Models\AlertModel;
use App\Models\MessageModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $allowedRoutes = [
            '/login',
            '/auth/login',
            '/auth/dologin',
        ];

        $currentPath = $this->request->getUri()->getPath();

        if (!session()->get('logged_in') && !in_array($currentPath, $allowedRoutes)) {
            return redirect()->to('/login')->send();
        }

        // Penambahan: ambil data alert dan message dari database
        $alertModel = new AlertModel();
        $messageModel = new MessageModel();

        $alerts = $alertModel->where('status', 'unread')->orderBy('created_at', 'DESC')->findAll(5);
        $messages = $messageModel->orderBy('created_at', 'DESC')->findAll(5);

        $renderer = service('renderer');
        $renderer->setData(['alerts' => $alerts, 'messages' => $messages]);
    }
}
