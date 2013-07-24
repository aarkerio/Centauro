<?php
$this->set('title_for_layout', 'Welcome');
?>
<div style="margin: 0 auto 0 auto;padding:6px;">
<h2><?php echo $this->Session->read('Auth.User.username'); ?> sections</h2>

<div style="border:1px solid black;margin-bottom:15px">

<?php
# TODOs
$tmp  = $this->Html->link($this->Html->image('admin/your-todo.png', array('title'=>'Your TODOs','alt'=>'Your TODOs')), '/admin/todos/listing', array('escape'=>False)).'<br />'; 
$tmp .= $this->Html->link('ToDos', '/admin/todos/listing', array('title'=>'ToDos', 'class'=>'main-item-caption'));
echo $this->Html->div('main-item', $tmp, array('title'=>'"Your TODOs', 'onclick'=>"document.location.href='/admin/todos/listing'"));

# Quick News
$tmp  = $this->Html->link($this->Html->image('admin/your-qn.png', array('title'=>'Quick news','alt'=>'Quick news')), '/admin/quicks/listing', array('escape'=>False)).'<br />'; 
$tmp .= $this->Html->link('Quick News', '/admin/quicks/listing', array('title'=>'Blog', 'class'=>'main-item-caption'));
echo $this->Html->div('main-item', $tmp, array('title'=>'Quick news', 'onclick'=>"document.location.href='/admin/quicks/listing'"));


# Your Bookmarks
$tmp  = $this->Html->link($this->Html->image('admin/your-bookmarks.png', array('title'=>'Your Bookmarks','alt'=>'Your Bookmarks')), '/admin/bookmarks/listing', array('escape'=>False)).'<br />'; 
$tmp .= $this->Html->link('Your Bookmarks', '/admin/bookmarks/listing', array('title'=>'Your Bookmarks', 'class'=>'main-item-caption'));
echo $this->Html->div('main-item', $tmp, array('title'=>'Your Bookmarks', 'onclick'=>"document.location.href='/admin/bookmarks/listing'"));

# Contacts
$tmp  = $this->Html->link($this->Html->image('admin/your-contacts.png', array('title'=>'Contacts','alt'=>'Contacts')), '/admin/contacts/listing', array('escape'=>False)).'<br />'; 
$tmp .= $this->Html->link('Contacts', '/admin/contacts/listing', array('title'=>'Contacts', 'class'=>'main-item-caption'));
echo $this->Html->div('main-item', $tmp, array('title'=>'Contacts', 'onclick'=>"document.location.href='/admin/contacts/listing'"));

# Your blog
$tmp  = $this->Html->link($this->Html->image('admin/your-blog.png', array('title'=>'Your blog','alt'=>'Your blog')), '/admin/entries/listing', array('escape'=>False)).'<br />'; 
$tmp .= $this->Html->link('Your blog', '/admin/entries/listing', array('title'=>'Your blog', 'class'=>'main-item-caption'));
echo $this->Html->div('main-item', $tmp, array('title'=>'Your blog', 'onclick'=>"document.location.href='/admin/entries/listing'"));
?>

<div class="main-item">
      <?php echo $this->Html->link($this->Html->image('admin/your-comments.png', array("title"=>"Comments", "alt"=>"Comments")), '/admin/commentblogs/listing',  array('escape'=>False)); ?>
      <a href="/admin/commentblogs/listing" title="Comments on your blog" class="main-item-caption">Comments</a>
</div>

<div class="main-item">
     <?php echo $this->Html->link($this->Html->image('admin/your-design.png', array("title"=>"Your Design", "alt"=>"Your Design")), '/admin/styles/listing',  array('escape'=>False)); ?>
     <a href="/admin/styles/listing" title="Your CSS Design" class="main-item-caption"><br	>CSS Design</a>
</div>

<div class="main-item">
      <?php echo $this->Html->link($this->Html->image('admin/your-news.png', array("title"=>"Your", "alt"=>"News")), '/admin/news/listing',  array('escape'=>False)); ?>
       <a href="/admin/news/listing" title="Your News" class="main-item-caption"><br>Front End News</a>
</div>
<div class="main-item">
       <?php echo $this->Html->link($this->Html->image('admin/your-podcast.png', array("title"=>"Podcast", "alt"=>"Podcast")), '/admin/podcasts/listing',  array('escape'=>False)); ?>
        <a href="/admin/podcasts/listing" title="Podcasts" class="main-item-caption">Podcast</a>
</div>
<div class="main-item">
      <?php echo $this->Html->link($this->Html->image('admin/your-pages.png', array("title"=>"Pages", "alt"=>"Pages")), '/admin/pages/sections',  array('escape'=>False)); ?>
      <a href="/admin/pages/sections" title="Pages" class="main-item-caption">Pages</a>
</div>
<div class="main-item">
      <?php echo $this->Html->link($this->Html->image('admin/your-galleries.png', array("title"=>"Galleries", "alt"=>"Galleries")), '/admin/galleries/listing',  array('escape'=>False)); ?>
      <a href="/admin/galleries/listing" title="3AYour blog" class="main-item-caption">Galleries</a>
</div>
<div class="main-item">
     <?php echo $this->Html->link($this->Html->image('admin/your-shares.png', array("title"=>"Phorum", "alt"=>"Phorum")), '/admin/shares/listing',  array('escape'=>False)); ?><br />
     <a href="/admin/shares/listing" title="Your files" class="main-item-caption">Files</a>
</div>
<div class="main-item">
      <?php echo $this->Html->link($this->Html->image('admin/your-images.png', array("title"=>"Your images", "alt"=>"Your Images")), '/admin/images/listing',  array('escape'=>False)); ?>
      <a href="/admin/images/listing" title="Your blog" class="main-item-caption">Images</a>
</div>
<div class="main-item">
     <?php echo $this->Html->link($this->Html->image('admin/your-download.png', array("title"=>'Downloads', "alt"=>"Downloads")), '/admin/downloads/listing',  array('escape'=>False)); ?>
     <a href="/admin/downloads/listing" title="Your blog" class="main-item-caption">Downloads</a>
</div>

<div class="main-item">
<?php echo $this->Html->link($this->Html->image('admin/your-messages.png', array("title"=>"Quotes", "alt"=>"Quotes")), '/admin/messages/listing', array('escape'=>False)); ?>
     <a href="/admin/messages/listing" title="Your blog" class="main-item-caption">Messages</a>
</div>

<?php
# Quote
$tmp  = $this->Html->link($this->Html->image('admin/your-quotes.png', array('title'=>'Quotes','alt'=>'Quotes')), '/admin/quotes/listing', array('escape'=>False)).'<br />'; 
$tmp .= $this->Html->link('Quotes', '/admin/quotes/listing', array('title'=>'Quotes', 'class'=>'main-item-caption'));
echo $this->Html->div('main-item', $tmp, array('title'=>'Quotes', 'onclick'=>"document.location.href='/admin/quotes/listing'"));
?>

<div class="main-item">
     <?php echo $this->Html->link($this->Html->image('admin/your-backups.png', array("title"=>"Your Design", "alt"=>"Your Design")), '/admin/users/backup', array('escape'=>False)); ?>
     <a href="/admin/users/backup" title="Your blog" class="main-item-caption">Backups</a>
</div>

<!-- div class="main-item">
     <?php echo $this->Html->link($this->Html->image('admin/your-groups.png', array('title'=>'Tus comunidades', 'alt'=>'Tus comunidades')), '/admin/workgroups/listing', array('escape'=>False)); ?>
     <a href="/admin/workgroups/listing" title="Workgroups" class="main-item-caption">Workgroups</a>
</div -->
</div>

<div style="clear:both;"></div>

<?php if ($this->Session->read('Auth.User.group_id') == 1 ):  ?>
   <h2>Admin sections</h2>

<div style="border:1px solid black;margin-bottom:15px">

<div class="main-item">
       <?php echo $this->Html->link($this->Html->image('admin/your-blog.png', array("title"=>"Pages Sections", "alt"=>"Pages Sections")), '/admin/sections/listing', array('escape'=>False)); ?>
       <a href="/admin/sections/listing" title="Your blog" class="main-item-caption">Sections</a>
</div>

<?php
# Portal Forums
$tmp  = $this->Html->link($this->Html->image('admin/your-forums.png', array('title'=>'Site Forums','alt'=>'Site Forums')), '/admin/catforums/listing', array('escape'=>False)).'<br />'; 
$tmp .= $this->Html->link('Portal Forums', '/admin/catforums/listing', array('title'=>'Site Forums', 'class'=>'main-item-caption'));
echo $this->Html->div('main-item', $tmp, array('title'=>'Forums', 'onclick'=>"document.location.href='/admin/catforums/listing'"));
?>

<div class="main-item">
  <?php echo $this->Html->link($this->Html->image('admin/your-themes.png', array('title'=>'News Themes', 'alt'=>'News Themes')), '/admin/themes/listing', array('escape'=>False)); ?><br />
      <a href="/admin/themes/listing" title="Themes" class="main-item-caption">News Themes</a>
</div>
   
<div class="main-item">
    <?php echo $this->Html->link($this->Html->image('admin/your-opinion.png', array("title"=>"Polls", "alt"=>"Polls")), '/admin/polls/listing', array('escape'=>False)); ?><br />
    <a href="/admin/polls/listing" title="Your blog" class="main-item-caption">Polls</a>
</div>

<div class="main-item">
    <?php echo $this->Html->link($this->Html->image('admin/your-users.png', array("title"=>"Users", "alt"=>"Users")), '/admin/users/listing', array('escape'=>False)); ?>
       <a href="/admin/users/listing" title="Your blog" class="main-item-caption">Users</a>
</div>


<div class="main-item">
      <?php echo $this->Html->link($this->Html->image('admin/your-gbackup.png', array("title"=>"General Backup", "alt"=>"General Backup")), '/admin/users/backup', array('escape'=>False)); ?>
     <a href="/admin/users/backup" title="Your blog" class="main-item-caption">Backup</a>
</div>

<?php endif; ?>
</div>
</div>
