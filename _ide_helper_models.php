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
 * @property integer $type
 * @property integer $counter
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereCounter($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Achievement whereUpdatedAt($value)
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
 * maze\Answer
 *
 * @property integer $id
 * @property integer $poll_id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \maze\Poll $poll
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\PollVote[] $votes
 * @method static \Illuminate\Database\Query\Builder|\maze\Answer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Answer wherePollId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Answer whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Answer whereUpdatedAt($value)
 */
	class Answer {}
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
 * @property-read \maze\User $user
 * @property-read \maze\User $follower
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower whereFollowerId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower latest()
 * @method static \Illuminate\Database\Query\Builder|\maze\Follower limited()
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

namespace maze\Modules\Confer{
/**
 * maze\Modules\Confer\Conversation
 *
 * @property integer $id
 * @property string $name
 * @property boolean $is_private
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\User[] $participants
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Modules\Confer\Message[] $messages
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Conversation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Conversation whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Conversation whereIsPrivate($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Conversation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Conversation ignoreGlobal()
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Conversation isPrivate()
 */
	class Conversation {}
}

namespace maze\Modules\Confer{
/**
 * maze\Modules\Confer\Message
 *
 * @property integer $id
 * @property string $body
 * @property integer $conversation_id
 * @property integer $sender_id
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $html
 * @property-read \maze\Modules\Confer\Conversation $conversation
 * @property-read \maze\User $sender
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Message whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Message whereConversationId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Message whereSenderId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Message whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Modules\Confer\Message whereUpdatedAt($value)
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Topic[] $topics
 * @property-read \maze\Node $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Node[] $children
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
 * @property-read \User $user
 * @property-read \User $fromUser
 * @property-read mixed $object
 * @property-read mixed $icon
 * @property-read mixed $body
 * @property-read mixed $topic
 * @property-read mixed $url
 * @property-read mixed $notification
 * @property-read mixed $activity
 * @property-read mixed $is_read
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereFromId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereObjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification whereReadAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification profile()
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification user()
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification latest()
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification mentions()
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification topics()
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification replies()
 * @method static \Illuminate\Database\Query\Builder|\maze\Notification statuses()
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
 * maze\Poll
 *
 * @property integer $id
 * @property integer $topic_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\PollVote[] $votes
 * @property-read \maze\Topic $topic
 * @property-read \maze\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Answer[] $answers
 * @method static \Illuminate\Database\Query\Builder|\maze\Poll whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Poll whereTopicId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Poll whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Poll whereUpdatedAt($value)
 */
	class Poll {}
}

namespace maze{
/**
 * maze\PollVote
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $poll_id
 * @property integer $answer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \maze\Poll $poll
 * @property-read \maze\User $user
 * @property-read \maze\Answer $answer
 * @method static \Illuminate\Database\Query\Builder|\maze\PollVote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\PollVote whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\PollVote wherePollId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\PollVote whereAnswerId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\PollVote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\PollVote whereUpdatedAt($value)
 */
	class PollVote {}
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
 * @property boolean $is_answer
 * @property-read \maze\User $user
 * @property-read \maze\Topic $topic
 * @property-read mixed $url
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
 * @method static \Illuminate\Database\Query\Builder|\maze\Reply whereIsAnswer($value)
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
 * @property string $body_original
 * @property integer $edited_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\StatusComment[] $statusComments
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\StatusComment[] $comments
 * @property-read \maze\User $user
 * @property-read \maze\User $editor
 * @property-read mixed $excerpt
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereCommentCount($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereBodyOriginal($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Status whereEditedBy($value)
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
 * @property string $body_original
 * @property-read \maze\Status $status
 * @property-read \maze\User $user
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\StatusComment whereBodyOriginal($value)
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
 * @property integer $type
 * @property boolean $is_answered
 * @property boolean $pin_local
 * @property integer $weight
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Reply[] $replies
 * @property-read \maze\User $user
 * @property-read \maze\Node $node
 * @property-read \maze\Poll $poll
 * @property-read mixed $full_type
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
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereIsAnswered($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic wherePinLocal($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic popular()
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic latest()
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic games()
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic pinnedLocal()
 * @method static \Illuminate\Database\Query\Builder|\maze\Topic pinned()
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
 * @property \Carbon\Carbon $dob
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
 * @property \Carbon\Carbon $last_login
 * @property \Carbon\Carbon $last_action
 * @property \Carbon\Carbon $notifications_read
 * @property boolean $email_replies
 * @property boolean $email_messages
 * @property boolean $email_news
 * @property boolean $can_vote
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Topic[] $topics
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Reply[] $replies
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Notification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Notification[] $statuses
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Follower[] $followers
 * @property-read mixed $is_following
 * @property-read mixed $avatar
 * @property-read mixed $age
 * @property-read mixed $role
 * @property-read mixed $is_staff
 * @property-read mixed $has_about
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.role')[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Modules\Confer\Conversation[] $conversations
 * @property-read \Illuminate\Database\Eloquent\Collection|\maze\Modules\Confer\Message[] $sent
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
 * @method static \Illuminate\Database\Query\Builder|\maze\User whereCanVote($value)
 * @method static \Illuminate\Database\Query\Builder|\maze\User ignoreMe()
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

