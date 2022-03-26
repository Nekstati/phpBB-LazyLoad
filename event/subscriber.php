<?php

namespace nekstati\lazyload\event;

class subscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		if (defined('ADMIN_START'))
		{
			return [];
		}

		return [
			'core.text_formatter_s9e_configure_after'		=> 'modify_img_tag_in_bbcode',
			'core.parse_attachments_modify_template_data'	=> ['modify_img_tag_in_attachment', -10],
			'core.get_avatar_after'							=> 'modify_img_tag_in_avatar',
		];
	}

	/* @var \phpbb\auth\auth */
	protected $auth;

	/* @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\language\language */
	protected $language;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\request\request */
	protected $request;

	/* @var \phpbb\template\template */
	protected $template;

	/* @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $table_prefix;

	public function __construct(
		\phpbb\auth\auth $auth,
		\phpbb\config\config $config,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\language\language $language,
		\phpbb\controller\helper $helper,
		\phpbb\request\request $request,
		\phpbb\template\template $template,
		\phpbb\user $user,
		$root_path,
		$table_prefix
	)
	{
		$this->auth			= $auth;
		$this->config		= $config;
		$this->db			= $db;
		$this->language 	= $language;
		$this->helper   	= $helper;
		$this->request  	= $request;
		$this->template 	= $template;
		$this->user 		= $user;
		$this->root_path  	= $root_path;
		$this->table_prefix	= $table_prefix;
	}

	public function modify_img_tag_in_bbcode($event)
	{
		// $event['configurator']->tags['IMG']->template->setContent('<xsl:choose><xsl:when test="$S_VIEWIMG"><img loading="lazy" src="{@src}" class="postimage" alt="{$L_IMAGE}"/></xsl:when><xsl:otherwise><xsl:apply-templates/></xsl:otherwise></xsl:choose>');
		$event['configurator']->tags['IMG']->template->setContent(str_replace('<img ', '<img loading="lazy" ', $event['configurator']->tags['IMG']->template->__toString()));
	}

	public function modify_img_tag_in_attachment($event)
	{
		if (!empty($event['block_array']['S_IMAGE']))
			$event['block_array'] = array_replace($event['block_array'], ['U_INLINE_LINK' => ($event['block_array']['U_INLINE_LINK'] . '" loading="lazy')]);
		elseif (!empty($event['block_array']['S_THUMBNAIL']))
			$event['block_array'] = array_replace($event['block_array'], ['THUMB_IMAGE' => ($event['block_array']['THUMB_IMAGE'] . '" loading="lazy')]);
	}

	public function modify_img_tag_in_avatar($event)
	{
		$event['html'] = str_replace('<img ', '<img loading="lazy" ', $event['html']);
	}
}
