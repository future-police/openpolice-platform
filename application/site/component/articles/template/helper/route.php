<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Route Template Helper
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Articles
 */
class ArticlesTemplateHelperRoute extends PagesTemplateHelperRoute
{
	public function article($config = array())
	{
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
           'layout' => null
        ));

        $article = $config->row;

        // TODO: I think that instead of the categories_category_id we should use the category parent
        $needles = array(
            array('view' => 'article' , 'id' => $article->id),
            array('view' => 'category', 'id' => $article->categories_category_id)
		);

        $route = array(
            'view'     => 'article',
            'id'       => $article->getSlug(),
            'layout'   => $config->layout,
            'category' => $config->category,
        );

        if (($page = $this->_findPage($needles)) || ($article->isPageable() && ($page = $article->getPage()))) {
            $route['Itemid'] = $page->id;
        }

		return $this->getTemplate()->getView()->getRoute($route);
	}

    public function category($config = array())
    {
        $config   = new Library\ObjectConfig($config);
        $config->append(array(
            'layout' => 'table'
        ));

        $category = $config->row;

        $needles = array(
            array('view' => 'category'   , 'id' => $category->id),
        );

        $route = array(
            'view'      => 'articles',
            'category'  => $category->getSlug(),
            'layout'    => $config->layout
        );

        if($item = $this->_findPage($needles))
        {
            if(isset($item->getLink()->query['layout'])) {
                $route['layout'] = $item->getLink()->query['layout'];
            }

            $route['Itemid'] = $item->id;
        };

        return $this->getTemplate()->getView()->getRoute($route);
    }
}