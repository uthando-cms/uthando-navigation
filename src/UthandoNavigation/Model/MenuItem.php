<?php

namespace UthandoNavigation\Model;

use UthandoCommon\Model\Model;
use UthandoCommon\Model\ModelInterface;
use UthandoCommon\Model\NestedSetInterface;
use UthandoCommon\Model\NestedSet;

class MenuItem extends NestedSet implements ModelInterface, NestedSetInterface
{   
    use Model;
    
	/**
	 * @var int
	 */
	protected $menuItemId;
	
	/**
	 * @var int
	 */
	protected $menuId;
	
	/**
	 * @var string
	 */
	protected $label;
	
	/**
	 * @var string
	 */
	protected $params;
	
	/**
	 * @var string
	 */
	protected $route;
	
	/**
	 * @var string
	 */
	protected $uri;
	
	/**
	 * @var string
	 */
	protected $resource;
	
	/**
	 * @var int
	 */
	protected $visible;

    /**
     * @return int
     */
    public function getMenuItemId()
	{
		return $this->menuItemId;
	}

    /**
     * @param $menuItemId
     * @return $this
     */
    public function setMenuItemId($menuItemId)
	{
		$this->menuItemId = $menuItemId;
		return $this;
	}

    /**
     * @return int
     */
    public function getMenuId()
	{
		return $this->menuId;
	}

    /**
     * @param $menuId
     * @return $this
     */
    public function setMenuId($menuId)
	{
		$this->menuId = $menuId;
		return $this;
	}

    /**
     * @return string
     */
    public function getLabel()
	{
		return $this->label;
	}

    /**
     * @param $label
     * @return $this
     */
    public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}

    /**
     * @return string
     */
    public function getParams()
	{
		return $this->params;
	}

    /**
     * @param $params
     * @return $this
     */
    public function setParams($params)
	{
		$this->params = $params;
		return $this;
	}

    /**
     * @return string
     */
    public function getRoute()
	{
		return $this->route;
	}

    /**
     * @param $route
     * @return $this
     */
    public function setRoute($route)
	{
		$this->route = $route;
		return $this;
	}

    /**
     * @return string
     */
    public function getUri()
	{
		return $this->uri;
	}

    /**
     * @param $uri
     * @return $this
     */
    public function setUri($uri)
	{
		$this->uri = $uri;
		return $this;
	}

    /**
     * @return string
     */
    public function getResource()
	{
		return $this->resource;
	}

    /**
     * @param $resource
     * @return $this
     */
    public function setResource($resource)
	{
		$this->resource = $resource;
		return $this;
	}

    /**
     * @return int
     */
    public function getVisible()
	{
		return $this->visible;
	}

    /**
     * @param $visible
     * @return $this
     */
    public function setVisible($visible)
	{
		$this->visible = $visible;
		return $this;
	}

	public function isVisible()
    {
        return ($this->getVisible()) ? 'Yes' : 'No';
    }
    
    public function getRouteLabel()
    {
    	return ($this->route == '0') ? 'Category Heading' : $this->route;
    }
}
