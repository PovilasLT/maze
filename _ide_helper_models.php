<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace maze{
/**
 * maze\Achievement
 *
 * @property integer $id 
 * @property string $name 
 * @property string $image 
 * @property integer $counter 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $type 
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereCounter($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereType($value)
 */
	class Achievement {}
}

namespace maze{
/**
 * maze\Action
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property string $name 
 * @property string $item_name 
 * @property integer $item_id 
 * @property string $ip 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereItemName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereUpdatedAt($value)
 */
	class Action {}
}

namespace maze{
/**
 * maze\Conversation
 *
 */
	class Conversation {}
}

namespace maze{
/**
 * maze\Follower
 *
 * @property integer $id 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property integer $user_id 
 * @property integer $follower_id 
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereFollowerId($value)
 */
	class Follower {}
}

namespace maze{
/**
 * maze\Message
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property integer $dialogue_id 
 * @property string $body 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereDialogueId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereUpdatedAt($value)
 */
	class Message {}
}

namespace maze{
/**
 * maze\Node
 *
 * @property integer $id 
 * @property string $name 
 * @property string $slug 
 * @property integer $parent_node 
 * @property string $description 
 * @property integer $topic_count 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property integer $order 
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereParentNode($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereTopicCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereOrder($value)
 */
	class Node {}
}

namespace maze{
/**
 * maze\Notification
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property integer $from_id 
 * @property integer $object_id 
 * @property string $object_type 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $read_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereFromId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereReadAt($value)
 */
	class Notification {}
}

namespace maze{
/**
 * maze\Permission
 *
 * @property integer $id 
 * @property string $name 
 * @property string $display_name 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.role')[] $roles 
 * @method static \Illuminate\Database\Query\Builder|\maze\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Permission whereUpdatedAt($value)
 */
	class Permission {}
}

namespace maze{
/**
 * maze\Push
 *
 */
	class Push {}
}

namespace maze{
/**
 * maze\Reply
 *
 * @property integer $id 
 * @property string $body 
 * @property integer $user_id 
 * @property integer $topic_id 
 * @property boolean $is_block 
 * @property integer $vote_count 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $body_original 
 * @property string $slug 
 * @property string $deleted_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereTopicId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereIsBlock($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereVoteCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereBodyOriginal($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereDeletedAt($value)
 */
	class Reply {}
}

namespace maze{
/**
 * maze\Role
 *
 * @property integer $id 
 * @property string $name 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $color 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('auth.model')[] $users 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.permission')[] $perms 
 * @method static \Illuminate\Database\Query\Builder|\maze\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Role whereColor($value)
 */
	class Role {}
}

namespace maze{
/**
 * maze\Status
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property string $body 
 * @property integer $comment_count 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereCommentCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereDeletedAt($value)
 */
	class Status {}
}

namespace maze{
/**
 * maze\StatusComment
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property integer $status_id 
 * @property string $body 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereUpdatedAt($value)
 */
	class StatusComment {}
}

namespace maze{
/**
 * maze\Topic
 *
 * @property integer $id 
 * @property string $title 
 * @property string $body 
 * @property integer $user_id 
 * @property integer $node_id 
 * @property boolean $is_excellent 
 * @property boolean $is_wiki 
 * @property boolean $is_blocked 
 * @property integer $reply_count 
 * @property integer $view_count 
 * @property integer $favorite_count 
 * @property integer $vote_count 
 * @property integer $last_reply_user_id 
 * @property string $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property integer $order 
 * @property string $body_original 
 * @property string $excerpt 
 * @property string $slug 
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereNodeId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereIsExcellent($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereIsWiki($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereIsBlocked($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereReplyCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereFavoriteCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereVoteCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereLastReplyUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereBodyOriginal($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereExcerpt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereSlug($value)
 */
	class Topic {}
}

namespace maze{
/**
 * maze\User
 *
 * @property integer $id 
 * @property string $email 
 * @property string $username 
 * @property string $password 
 * @property integer $rank_id 
 * @property integer $group_id 
 * @property string $city 
 * @property string $dob 
 * @property string $about_me 
 * @property boolean $sex 
 * @property string $facebook 
 * @property string $twitter 
 * @property string $steam 
 * @property string $twitch 
 * @property string $website 
 * @property string $image_url 
 * @property string $cover_url 
 * @property boolean $is_banned 
 * @property string $remember_token 
 * @property integer $topic_count 
 * @property integer $reply_count 
 * @property integer $status_count 
 * @property integer $follower_count 
 * @property integer $wiki_count 
 * @property integer $karma_count 
 * @property integer $profile_views 
 * @property string $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property integer $notification_count 
 * @property string $slug 
 * @property string $skype 
 * @property string $youtube 
 * @property string $hitbox 
 * @property string $origin 
 * @property string $deviantart 
 * @property string $last_login 
 * @property string $last_action 
 * @property string $notifications_read 
 * @property boolean $email_replies 
 * @property boolean $email_messages 
 * @property boolean $email_news 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.role')[] $roles 
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereRankId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereDob($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereAboutMe($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereFacebook($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereTwitter($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereSteam($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereTwitch($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereWebsite($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereCoverUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereIsBanned($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereTopicCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereReplyCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereStatusCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereFollowerCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereWikiCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereKarmaCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereProfileViews($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereNotificationCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereSkype($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereYoutube($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereHitbox($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereOrigin($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereDeviantart($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereLastAction($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereNotificationsRead($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereEmailReplies($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereEmailMessages($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereEmailNews($value)
 */
	class User {}
}

namespace maze{
/**
 * maze\UserAchievement
 *
 */
	class UserAchievement {}
}

namespace maze{
/**
 * maze\Vote
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property integer $votable_id 
 * @property string $votable_type 
 * @property string $is 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereVotableId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereVotableType($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereIs($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereUpdatedAt($value)
 */
	class Vote {}
}

namespace maze{
/**
 * maze\Achievement
 *
 * @property integer $id 
 * @property string $name 
 * @property string $image 
 * @property integer $counter 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $type 
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereCounter($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereType($value)
 */
	class Achievement {}
}

namespace maze{
/**
 * maze\Action
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property string $name 
 * @property string $item_name 
 * @property integer $item_id 
 * @property string $ip 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereItemName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Action whereUpdatedAt($value)
 */
	class Action {}
}

namespace maze{
/**
 * maze\Conversation
 *
 */
	class Conversation {}
}

namespace maze{
/**
 * maze\Follower
 *
 * @property integer $id 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property integer $user_id 
 * @property integer $follower_id 
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereFollowerId($value)
 */
	class Follower {}
}

namespace maze{
/**
 * maze\Message
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property integer $dialogue_id 
 * @property string $body 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereDialogueId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Message whereUpdatedAt($value)
 */
	class Message {}
}

namespace maze{
/**
 * maze\Node
 *
 * @property integer $id 
 * @property string $name 
 * @property string $slug 
 * @property integer $parent_node 
 * @property string $description 
 * @property integer $topic_count 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property integer $order 
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereParentNode($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereTopicCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Node whereOrder($value)
 */
	class Node {}
}

namespace maze{
/**
 * maze\Notification
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property integer $from_id 
 * @property integer $object_id 
 * @property string $object_type 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $read_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereFromId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereReadAt($value)
 */
	class Notification {}
}

namespace maze{
/**
 * maze\Permission
 *
 * @property integer $id 
 * @property string $name 
 * @property string $display_name 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.role')[] $roles 
 * @method static \Illuminate\Database\Query\Builder|\maze\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Permission whereUpdatedAt($value)
 */
	class Permission {}
}

namespace maze{
/**
 * maze\Push
 *
 */
	class Push {}
}

namespace maze{
/**
 * maze\Reply
 *
 * @property integer $id 
 * @property string $body 
 * @property integer $user_id 
 * @property integer $topic_id 
 * @property boolean $is_block 
 * @property integer $vote_count 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $body_original 
 * @property string $slug 
 * @property string $deleted_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereTopicId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereIsBlock($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereVoteCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereBodyOriginal($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereDeletedAt($value)
 */
	class Reply {}
}

namespace maze{
/**
 * maze\Role
 *
 * @property integer $id 
 * @property string $name 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $color 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('auth.model')[] $users 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.permission')[] $perms 
 * @method static \Illuminate\Database\Query\Builder|\maze\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Role whereColor($value)
 */
	class Role {}
}

namespace maze{
/**
 * maze\Status
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property string $body 
 * @property integer $comment_count 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereCommentCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereDeletedAt($value)
 */
	class Status {}
}

namespace maze{
/**
 * maze\StatusComment
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property integer $status_id 
 * @property string $body 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereUpdatedAt($value)
 */
	class StatusComment {}
}

namespace maze{
/**
 * maze\Topic
 *
 * @property integer $id 
 * @property string $title 
 * @property string $body 
 * @property integer $user_id 
 * @property integer $node_id 
 * @property boolean $is_excellent 
 * @property boolean $is_wiki 
 * @property boolean $is_blocked 
 * @property integer $reply_count 
 * @property integer $view_count 
 * @property integer $favorite_count 
 * @property integer $vote_count 
 * @property integer $last_reply_user_id 
 * @property string $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property integer $order 
 * @property string $body_original 
 * @property string $excerpt 
 * @property string $slug 
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereNodeId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereIsExcellent($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereIsWiki($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereIsBlocked($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereReplyCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereFavoriteCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereVoteCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereLastReplyUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereBodyOriginal($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereExcerpt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereSlug($value)
 */
	class Topic {}
}

namespace maze{
/**
 * maze\User
 *
 * @property integer $id 
 * @property string $email 
 * @property string $username 
 * @property string $password 
 * @property integer $rank_id 
 * @property integer $group_id 
 * @property string $city 
 * @property string $dob 
 * @property string $about_me 
 * @property boolean $sex 
 * @property string $facebook 
 * @property string $twitter 
 * @property string $steam 
 * @property string $twitch 
 * @property string $website 
 * @property string $image_url 
 * @property string $cover_url 
 * @property boolean $is_banned 
 * @property string $remember_token 
 * @property integer $topic_count 
 * @property integer $reply_count 
 * @property integer $status_count 
 * @property integer $follower_count 
 * @property integer $wiki_count 
 * @property integer $karma_count 
 * @property integer $profile_views 
 * @property string $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property integer $notification_count 
 * @property string $slug 
 * @property string $skype 
 * @property string $youtube 
 * @property string $hitbox 
 * @property string $origin 
 * @property string $deviantart 
 * @property string $last_login 
 * @property string $last_action 
 * @property string $notifications_read 
 * @property boolean $email_replies 
 * @property boolean $email_messages 
 * @property boolean $email_news 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.role')[] $roles 
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereRankId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereDob($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereAboutMe($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereFacebook($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereTwitter($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereSteam($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereTwitch($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereWebsite($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereCoverUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereIsBanned($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereTopicCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereReplyCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereStatusCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereFollowerCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereWikiCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereKarmaCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereProfileViews($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereNotificationCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereSkype($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereYoutube($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereHitbox($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereOrigin($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereDeviantart($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereLastAction($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereNotificationsRead($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereEmailReplies($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereEmailMessages($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereEmailNews($value)
 */
	class User {}
}

namespace maze{
/**
 * maze\UserAchievement
 *
 */
	class UserAchievement {}
}

namespace maze{
/**
 * maze\Vote
 *
 * @property integer $id 
 * @property integer $user_id 
 * @property integer $votable_id 
 * @property string $votable_type 
 * @property string $is 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereVotableId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereVotableType($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereIs($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Vote whereUpdatedAt($value)
 */
	class Vote {}
}

