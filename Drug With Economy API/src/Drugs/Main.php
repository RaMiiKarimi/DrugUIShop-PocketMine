<?php


namespace Drugs;






use jojoe77777\FormAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\item\ChorusFruit;
use pocketmine\item\DriedKelp;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat as R;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener{

	public $prefix = "§5Drugs";
	public $economy;

	public function onLoad()
	{
		$this->getLogger()->info(R::LIGHT_PURPLE . "$this->prefix Dar Hal Load Ast");
	}

	public function onEnable()
	{
		$this->getServer()->getPluginManager()->getPlugin("Economy API");
		$this->getServer()->getPluginManager()->getPlugin("Form API");
		$this->getLogger()->info(R::DARK_PURPLE . "$this->prefix Enable Shod");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);

	}
	public function onDisable()
	{
		$this->getLogger()->info(R::DARK_RED . "$this->prefix Disable Shod");
	}

	public function onConsume(PlayerItemConsumeEvent $event)
	{
		$item = $event->getItem();
		$player = $event->getPlayer();
		if($event->getItem()->getId() === 464){
			$item->pop();
			$player->getInventory()->setItemInHand($item);
			$player->addEffect(new EffectInstance(Effect::getEffect(Effect::NAUSEA), 180*20, 1, true));
			$player->addEffect(new EffectInstance(Effect::getEffect(Effect::POISON), 70*20, 1, true));
			$player->addEffect(new EffectInstance(Effect::getEffect(Effect::SATURATION), 180*20, 1, true));
			$player->addEffect(new EffectInstance(Effect::getEffect(Effect::SLOWNESS) , 100*20 , 1 , true));
				$player->sendMessage("Dari §4Naeshe§r Mishi ! :)");
				return;
			}
		}
	public function onConsume1(PlayerItemConsumeEvent $event)
	{
		$item = $event->getItem();
		$player = $event->getPlayer();
		if($event->getItem()->getId() === 373) {
			$item->pop();
			$player->getInventory()->setItemInHand($item);
			$player->addEffect(new EffectInstance(Effect::getEffect(Effect::NAUSEA), 180*20, 1, true));
			$player->addEffect(new EffectInstance(Effect::getEffect(Effect::POISON), 70*20, 1, true));
			$player->addEffect(new EffectInstance(Effect::getEffect(Effect::SATURATION), 180*20, 1, true));
			$player->addEffect(new EffectInstance(Effect::getEffect(Effect::SLOWNESS) , 100*20 , 1 , true));
			$player->sendMessage("Dari §4Mast§r Mishi ! :)");
			return;
		}
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool
	{
		switch ($cmd->getName()) {
			case "drugshop":
				if ($sender instanceof Player) {
					$this->openMyForm($sender);
				} else {
					$sender->sendMessage("In Command Ro Dar Game Type Konid .");
				}
		}
		return true;
	}




	public function openMyForm($sender)
{
	$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null) {
		if ($data === null) {
			return true;


		}
		switch ($data) {

			case 0:
				$this->MavadMenu($player);
				break;

			case 1:
				$player->sendMessage("Shoma Ba Movafaqiat Az Drug Shop Kharej Shodid .");
				break;


		}
	});
	$form->setTitle("§8Drug Shop");
	$form->addButton("§l§0Kharid Drug", 0);
	$form->addButton("§l§4Khrooj", 1, "textures/blocks/barrier");
	$form->sendToPlayer($sender);
	return true;

}

	public function MavadMenu($player){

		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null) {
			if ($data === null) {
				return true;


			}
			switch ($data) {

				case 0:
					$money = EconomyAPI::getInstance()->myMoney($player);
					if ($money >= 35) {

						EconomyAPI::getInstance()->reduceMoney($player, 35);
						$player->getInventory()->addItem(item::get(464, 0, 1)->setCustomName("Mavad Shoma"));
						$player->sendMessage('Shoma Ba Movafaqiat Mavad Kharidid');
					} else {
						$player->sendMessage('Shoma Ejaze Kharid Mavad Ra Nadarid');
						break;
					}
					return true;

				case 1:
					$money = EconomyAPI::getInstance()->myMoney($player);
					if ($money >= 40) {

						EconomyAPI::getInstance()->reduceMoney($player, 40);
						$player->getInventory()->addItem(item::get(373, 23, 1)->setCustomName("Mavad Shoma"));
						$player->sendMessage('Shoma Ba Movafaqiat Mavad Kharidid');
					} else {
						$player->sendMessage('Shoma Ejaze Kharid Mavad Ra Nadarid');
						break;
					}
					return true;



				case 2:
					$money = EconomyAPI::getInstance()->myMoney($player);
					if ($money >= 25) {

						EconomyAPI::getInstance()->reduceMoney($player, 25);
						$player->getInventory()->addItem(item::get(373,40 , 1)->setCustomName("Vodka"));
						$player->sendMessage('Shoma Ba Movafaqiat Mavad Kharidid');
					} else {
						$player->sendMessage('Shoma Ejaze Kharid Mavad Ra Nadarid');
						break;
					}
					return true;

				case 3:
					$money = EconomyAPI::getInstance()->myMoney($player);
					if ($money >= 20) {

						EconomyAPI::getInstance()->reduceMoney($player, 20);
						$player->getInventory()->addItem(item::get(373, 0, 1)->setCustomName("Aragh Sagi"));
						$player->sendMessage('Shoma Ba Movafaqiat Mavad Kharidid');
					} else {
						$player->sendMessage('Shoma Ejaze Kharid Mavad Ra Nadarid');
						break;
					}
					return true;


				case 4:
					$player->sendMessage("Shoma ba Movafaqiat Kharej Shodid");
					break;
			}



			return true;

		});
		$form->setTitle("§8§lMavad Haye Moojod");
		$form->setContent("Baraye Kharid Mavad Click Konid");
		$form->addButton("§l§0Teryak");
		$form->addButton("§l§4MashRoob");
		$form->addButton("§lVodka");
		$form->addButton("Aragh Sagi");
		$form->addButton("§l§cKhrooj");
		$form->sendToPlayer($player);




	}



}