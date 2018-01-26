<?php
function _l($str_name)
{
    global $_l;
    if (isset($_l[$str_name])) return $_l[$str_name];
    else return $str_name;
}

$_l = array();

//-- global
$_l['admincp']         = 'Administration Control Panel';
$_l['home']            = 'Home';
$_l['manage']          = 'Manage';
$_l['action']          = 'Action';
$_l['ordon']           = 'Order';
$_l['menus']           = 'Menus';
$_l['noentries']       = 'No entries found';
$_l['parent']          = 'Parent';
$_l['root']            = 'None';
$_l['uncategorized']   = 'Uncategorized';
$_l['separatecommas']  = 'Separate with commas';
$_l['general']         = 'General';
$_l['additionnal']     = 'Additionnal';
$_l['seo']             = 'SEO';
$_l['login']           = 'Login';
$_l['username']        = 'Username';
$_l['password']        = 'Password';
$_l['logout']          = 'Logout';
$_l['search']          = 'Search';
$_l['all']             = 'All';
$_l['count']           = 'Count';
$_l['google_verify']   = 'Google verify code';
$_l['google_profile_id']   = 'Google analytics profile ID';
$_l['yahoo_verify']    = 'Yahoo verify code';
$_l['sitemap']         = 'Sitemap';
$_l['generate']        = 'Generate';
$_l['rebuild']         = 'Rebuild';
$_l['result']          = 'Result';
$_l['article_page_limit'] = 'Number of articles / page';
$_l['path']            = 'Path';
$_l['tag_total']       = 'Tag total limit';


//-- modules
$_l['config']   = 'Configuration';
$_l['page']     = 'Page';
$_l['pages']    = 'Pages';
$_l['category'] = 'Category';
$_l['categories'] = 'Categories';
$_l['article']  = 'Article';
$_l['gallery']  = 'Gallery';
$_l['articles'] = 'Articles';
$_l['keyword']  = 'Keyword';
$_l['tag']      = 'Tag';
$_l['adsense']  = 'Adsense';
$_l['script']   = 'Script';
$_l['theme']    = 'Theme';
$_l['util']     = 'Utils';
$_l['link']     = 'Link';
$_l['domain']   = 'Domain';
$_l['lang']     = 'Language';
$_l['comment']  = 'Comment';
$_l['comments'] = 'Comments';
$_l['banner']   = 'Banner';
$_l['center']   = 'Center';
$_l['statistics'] = 'Statistics';
$_l['analytics']  = 'Analytics';
$_l['dbform']     = 'Database/Form';
$_l['log']        = 'Loging';
$_l['faq']        = 'F.A.Q.';


//-- fields
$_l['id']              = 'Id';
$_l['name']            = 'Name';
$_l['title']           = 'Title';
$_l['description']     = 'Description';
$_l['content']         = 'Contents';
$_l['rewrite_engine']  = 'Rewrite Engine';
$_l['rewrite_engine_method']  = 'Rewrite Engine Method';
$_l['rewrite_engine_string']  = 'Rewrite Engine String';
$_l['searchengine']    = 'Search Engine';
$_l['google_email']    = 'Google Email';
$_l['google_password'] = 'Google Password';
$_l['sitemap_dir']     = 'Sitemap Directory';
$_l['keywords']        = 'Keywords';
$_l['site_keyword']    = 'Site Keyword';
$_l['tags']            = 'Tags';
$_l['total']           = 'Count';
$_l['position']        = 'Position';
$_l['channel']         = 'Channel';
$_l['publish']         = 'Publish';
$_l['published']       = 'Published on';
$_l['added']           = 'Added on';
$_l['email']           = 'Email';
$_l['title_separator'] = 'Title Separator';
$_l['title_prefix']    = 'Title Prefix';
$_l['title_sufix']     = 'Title Sufix';
$_l['auto_publish']    = 'Auto Publish';
$_l['domain_page']         = 'Domain Page';
$_l['unpublished']     = 'Unpublished';
$_l['image']		   = 'Image';


$_l['article_home_limit']    = 'Article Home Count';
$_l['article_news_limit']    = 'Article News Count';

$_l['article_best_limit']          = 'Article Best Count';
$_l['article_last_limit']          = 'Article Last Count';
$_l['article_most_rated_limit']    = 'Article Most Rated Count';
$_l['article_best_rated_limit']    = 'Article Best Rated Count';

$_l['raty']    = 'Raty';
$_l['totalraty']    = 'Raty (Count)';

$_l['article_publish_interval'] = 'Auto Publish Interval (Minutes)';
$_l['article_publish_date']     = 'Auto Publish Date';
$_l['order_by']        = 'Order By';
$_l['url']             = 'Url';
$_l['motto']           = 'Motto';
$_l['alias']           = 'Alias';
$_l['script_html']     = 'Script/Movie/Html';
$_l['adsense_ignore']  = 'Ignore IP';
$_l['adsense_ignore_ip'] = 'IP(s) list';
$_l['category_prefix']   = 'Category Prefix';
$_l['category_sufix']    = 'Category Sufix';
$_l['article_prefix']    = 'Article Prefix';
$_l['article_sufix']     = 'Article Sufix';
$_l['site_template']     = 'Template';
$_l['site_style']        = 'Style';
$_l['generatearticlesrandom']     = 'Publish Articles Random';
$_l['generatecategoriesandarticlesrandom']     = 'Publish Categories and Articles Random';
$_l['generatearticlesfromcategoryrandom']     = 'Publish Articles from Category Random';
$_l['view']        = 'View';
$_l['files']       = 'Files';

$_l['fieldname']       = 'Field';
$_l['fieldtype']       = 'Type';
$_l['fieldlength']     = 'Length';
$_l['formtype']        = 'Object';
$_l['defaultvalue']    = 'Default';
$_l['startdate']       = 'Start Date';
$_l['enddate']         = 'End Date';

//-- actions
$_l['add']      = 'Add';
$_l['mod']      = 'Modify';
$_l['del']      = 'Delete';
$_l['update']   = 'Update';
$_l['yes']      = 'Yes';
$_l['no']       = 'No';
$_l['import']   = 'Import';
$_l['active']   = 'Active';
$_l['confirmdelete']   = 'Are you sure?';
$_l['completed'] = 'Completed';


//-- positions
$_l['top'] = 'Top';
$_l['left'] = 'Left';
$_l['right'] = 'Right';
$_l['bottom'] = 'Bottom';
$_l['center'] = 'Center';
$_l['topleft']   = 'Top Left';
$_l['topright']  = 'Top Right';
$_l['centerleft']   = 'Center Left';
$_l['centerright']  = 'Center Right';
$_l['bottomleft']   = 'Bottom Left';
$_l['bottomright']  = 'Bottom Right';
?>