<div style="margin: 0 auto;padding:8px;width:420px">

<div class="title_section">
   <?php print$this->Session->read('Auth.User.name'); ?>'s sections <a href="/users/blog/<?php print $othAuth->user('id') ?>" class="smallref">Blog</a>
</div>

<h2>Users sections</h2>

<div style="border:1px solid black;margin-bottom:15px">

<div class="main-item" title="ClassRooms" onclick="document.location.href = '/vclassrooms/listing'">
  <span class="main-item-icon">
       <?php echo $this->Html->link($this->Html->image('vclass.png', array('title'=>"Classrooms", 'alt'=>"Classrooms")), '/vclassrooms/listing', null, null, false); ?>
  </span>
  <a href="/vclassrooms/listing" title="ClassRooms" class="main-item-caption">ClassRooms</a>
</div>

<div class="main-item" title="Blog" onclick="document.location.href = '/entries/list'">
  <span class="main-item-icon">
     <?php echo $this->Html->link($this->Html->image('blog.png', array('title'=>"EduBlog", 'alt'=>"EduBlog")), '/entries/listing', null, null, false); ?>
  </span>
  <a href="/entries/listing" title="Blog" class="main-item-caption">eduBlog</a>
</div>

<div class="main-item" title="Manage your eCourses in a pretty and fast way" onclick="document.location.href = '/ecourses/list'">
  <span class="main-item-icon">
      <?php echo $this->Html->link($this->Html->image('ecourses.png', array('title'=>"eCourses", 'alt'=>"eCourses")), '/ecourses/listing', null, null, false); ?>
  </span>
  <a href="/ecourses/listing" title="Manage your eCourses in a pretty and fast way" class="main-item-caption">eCourses</a>
</div>

<div class="main-item" title="Podcast" onclick="document.location.href = '/podcasts/list'">
  <span class="main-item-icon">
       <?php echo $this->Html->link($this->Html->image('ipod.png', array('title'=>"Podcast", 'alt'=>"Podcast")), '/podcasts/listing', null, null, false); ?>
  </span>
  <a href="/podcasts/listing" title="Podcast" class="main-item-caption">Podcast</a>
</div>

<div class="main-item" title="Lessons" onclick="document.location.href = '/lessons/listing'">
  <span class="main-item-icon">
      <?php echo $this->Html->link($this->Html->image('static_pages.png', array('title'=>"Lessons", 'alt'=>"Lessons")), '/lessons/listing', null, null, false); ?>
  </span>
  <a href="/lessons/listing" title="Lessons" class="main-item-caption">Lessons</a>
</div>

<div class="main-item" title="My Galleries" onclick="document.location.href = '/galleries/list'">
  <span class="main-item-icon">
      <?php echo $this->Html->link($this->Html->image('galleries.png', array('title'=>"Galleries", 'alt'=>"Galleries")), '/galleries/listing', null, null, false); ?>
  </span>
  <a href="/galleries/listing" title="Manage your Galleries" class="main-item-caption">My Galleries</a>
</div>

<div class="main-item" title="Create/Edit your FAQs" onclick="document.location.href = '/entries/list'">
  <span class="main-item-icon">
     <?php echo $this->Html->link($this->Html->image('faq.png', array('title'=>"FAQs", 'alt'=>"FAQs")), '/catfaqs/listing', null, null, false); ?>
  </span>
  <a href="/catfaqs/listing" title="Create/Edit your FAQs" class="main-item-caption">FAQs</a>
</div>

<div class="main-item" title="Glossary" onclick="document.location.href = '/catphorums/listing'">
  <span class="main-item-icon">
     <?php echo $this->Html->link($this->Html->image('messages.png', array('title'=>"Phorum", 'alt'=>"Phorum")), '/catphorums/listing', null, null, false); ?>
  </span>
  <a href="/catphorums/listing" title="Phorums" class="main-item-caption">Phorums</a>
</div>

<div class="main-item" title="Glossary" onclick="document.location.href = '/cat/glossaries/list'">
  <span class="main-item-icon">
     <?php echo $this->Html->link($this->Html->image('Glossary.png', array('title'=>"Glossary", 'alt'=>"Glossary")), '/catglossaries/listing', null, null, false); ?>
  </span>
  <a href="/catglossaries/listing" title="Glossary" class="main-item-caption">Glossary</a>
</div>

<div class="main-item" title="Manage your Webquests" onclick="document.location.href = '/webquests/list'">
  <span class="main-item-icon">
       <?php echo $this->Html->link($this->Html->image('webquests.png', array('title'=>"Webquests", 'alt'=>"Webquests")), '/webquests/listing', null, null, false); ?>
  </span>
  <a href="/webquests/listing" title="Manage your Webquests in a pretty and fast way" class="main-item-caption">Webquest</a>
</div>

<div class="main-item" title="Manage your comments" onclick="document.location.href = '/comments/listing'">
  <span class="main-item-icon">
      <?php echo $this->Html->link($this->Html->image('comments.png', array('title'=>"Comments", 'alt'=>"Comments")), '/comments/listing', null, null, false); ?>
  </span>
  <a href="/comments/listing" title="Comments" class="main-item-caption">Comments</a>
</div>

<div class="main-item" title="Media Manager" onclick="document.location.href = '/medias/list'">
  <span class="main-item-icon">
     <?php echo $this->Html->link($this->Html->image('mmultimedia.png', array('title'=>"Multimedia", 'alt'=>"Multimedia")), '/medias/listing', null, null, false); ?>
  </span>
  <a href="/medias/listing" title="Media Manager" class="main-item-caption">Multimedia manager</a>
</div>

<div class="main-item" title="Your links" onclick="document.location.href = '/vinculums/list'">
  <span class="main-item-icon">
     <?php echo $this->Html->link($this->Html->image('ylinks.png', array('title'=>"Friend Links", 'alt'=>"Friend Links")), '/vinculums/listing', null, null, false); ?>
  </span>
  <a href="/vinculums/listing" title="Your links" class="main-item-caption">Friend links</a>
</div>

<div class="main-item" title="Treasure hunt" onclick="document.location.href = '/treasures/list'">
  <span class="main-item-icon">
        <?php echo $this->Html->link($this->Html->image('thunt.png', array('title'=>"Treasures", 'alt'=>"Treasures")), '/treasures/listing', null, null, false); ?>
  </span>
  <a href="/treasures/listing" title="Treasure hunt" class="main-item-caption">Treasures hunt</a>
</div>

<div class="main-item" title="Quotes" onclick="document.location.href = '/quotes/list'">
  <span class="main-item-icon">
     <?php echo $this->Html->link($this->Html->image('quotes.png', array('title'=>"Quotes", 'alt'=>"Quotes")), '/quotes/listing', null, null, false); ?>
  </span>
  <a href="/quotes/listing" title="Quotes" class="main-item-caption">Quotes</a>
</div>

<div class="main-item" title="My Images" onclick="document.location.href = '/images/list'">
  <span class="main-item-icon">
      <?php echo $this->Html->link($this->Html->image('myimages.png', array('title'=>"My Images", 'alt'=>"My Images")), '/images/listing', null, null, false); ?>
  </span>
  <a href="/images/listing" title="My Images" class="main-item-caption">My Images</a>
</div>

<div class="main-item" title="Settings" onclick="document.location.href = '/messages/listing/'">
  <span class="main-item-icon">
       <?php echo $this->Html->link($this->Html->image('phorum.png', array('title'=>"Messages", 'alt'=>"Messages")), '/messages/listing', null, null, false); ?>
  <a href="/messages/listing/" title="My Settings" class="main-item-caption">Messages</a>
</div>

</div>
<div style="clear:both;"></div>


<?php if ($this->Session->read('Auth.User.group_id') == 1 ):  ?>
   <h2>Admin sections</h2>
<?php endif; ?>

<div style="border:1px solid black;margin-bottom:15px">

<?php if ($this->Session->read('Auth.User.group_id') == 1 ) { ?>
  <div class="main-item" title="News" onclick="document.location.href = '/news/listing'">
    <span class="main-item-icon">
       <?php echo $this->Html->link($this->Html->image('news-icon.png', array('title'=>"News", 'alt'=>"News")), '/news/listing', null, null, false); ?>
    </span>
    <a href="/news/listing" title="News" class="main-item-caption">News</a>
   </div>
<?php } ?>

<?php if ($this->Session->read('Auth.User.group_id') == 1 ) { ?>
  <div class="main-item" title="Subjects" onclick="document.location.href = '/subjects/listing'">
    <span class="main-item-icon">
      <?php echo $this->Html->link($this->Html->image('areas.png', array('title'=>"Subjects", 'alt'=>"Subjects")), '/subjects/listing', null, null, false); ?>
    <a href="/subjects/listing" title="Subjects" class="main-item-caption">Subjects</a>
   </div>
<?php } ?>

<?php if ($this->Session->read('Auth.User.group_id') == 1 ) { ?>
  <div class="main-item" title="Covers" onclick="document.location.href = '/covers/listing'">
    <span class="main-item-icon">
       <?php echo $this->Html->link($this->Html->image('cover-icon.png', array('title'=>"Covers", 'alt'=>"Covers")), '/covers/listing', null, null, false); ?>
    </span>
    <?php echo $this->Html->link("Covers", "/covers/listing", array('class'=>"main-item-caption") ) ?> 
   </div>
<?php } ?>

<?php if ($this->Session->read('Auth.User.group_id') == 1 ) { ?>
<div class="main-item" title="polls" onclick="document.location.href = '/polls/listing'">
  <span class="main-item-icon">
    <?php echo $this->Html->link($this->Html->image('Poll.png', array('title'=>"Polls", 'alt'=>"Polls")), '/polls/listing', null, null, false); ?>
  </span>
  <a href="/polls/listing" title="Polls" class="main-item-caption">Polls</a>
</div>
<?php } ?>

<?php if ($this->Session->read('Auth.User.group_id') == 1 ) { ?>
<div class="main-item" title="Users" onclick="document.location.href = '/users/listing'">
  <span class="main-item-icon">
       <?php echo $this->Html->link($this->Html->image('karamelo_users.png', array('title'=>"Users", 'alt'=>"Users")), '/users/listing', null, null, false); ?>
  </span>
  <a href="/vclassrooms/" title="ClassRooms" class="main-item-caption">Users</a>
</div>
<?php } ?>


<?php if ($this->Session->read('Auth.User.group_id') == 1 ) { ?>
<div class="main-item" title="Backup" onclick="document.location.href = '/backups/list'">
  <span class="main-item-icon">
      <?php echo $this->Html->link($this->Html->image('backup.png', array('title'=>"Backups", 'alt'=>"Polls")), '/backups/listing', null, null, false); ?>
  </span>
  <a href="/backups/listing" title="Backup" class="main-item-caption">Backup</a>
</div>
<?php } ?>

<?php if ($this->Session->read('Auth.User.group_id') == 1 ) { ?>
  <div class="main-item" title="Admin" onclick="document.location.href = '/admins/listing'">
    <span class="main-item-icon">
         <?php echo $this->Html->link($this->Html->image('admin.png', array('title'=>"Admin", 'alt'=>"Admin")), '/admins/listing', null, null, false); ?>
    </span>
    <a href="/covers/listing" title="News" class="main-item-caption">Admin</a>
   </div>
<?php } ?>

</div>
</div>
