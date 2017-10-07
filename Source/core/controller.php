<?php
/**
 * This classe is used as an interface for model classes.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 09/18/2017
 * @since   0.1
 */
class controller{

    /**
     * This function loads the view files to render the screen.
     *
     * @param $viewName The name of the view to load.
     * @param $viewData An array containing data to show in the view.
     */
    public function loadView($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }

    /**
     * This function loads the base template.
     *
     * @param $viewName The name of the view to load inside the template.
     * @param $viewData An array containing data to show in the view and the template.
     */
    public function loadTemplate($viewName, $viewData = array()){
        extract($viewData);
        require 'views/template.php';
    }

    /**
     * This function loads the view files to render the screen.
     *
     * @param $viewName The name of the view to load.
     * @param $viewData An array containing data to show in the view.
     */
    public function loadViewInTemplate($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }
}
