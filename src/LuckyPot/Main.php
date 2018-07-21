<?php
namespace LuckyPot;
//made by freaking dev
//deobfuscated by someone
usepocketminepluginPluginBase;
usepocketmineeventListener;
usepocketmineeventplayerPlayerJoinEvent;
usepocketmineeventplayerPlayerInteractEvent;
usepocketmineeventblockBlockBreakEvent;
usepocketmineutilsConfig;
usepocketmineutilsTextFormat;
usepocketminelevelparticleFloatingTextParticle;
usepocketminemathVector3;
usepocketminecommandCommand;
usepocketminecommandCommandSender;
usepocketminePlayer;
usepocketmineServer;
useoneboneeconomyapiEconomyAPI;
class Main extends PluginBase implements Listener

{
	public $set = 0;

	public $pot;

	private $config;
	public

	function onEnable()
	{
		if (!is_dir($this->getDataFolder())) @mkdir($this->getDataFolder());
		$this->config = (new Config($this->getDataFolder() . 'LuckyPot_DB.yml', Config::YAML))->getAll();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		//$this->getLogger()->info(TextFormat::GREEN . "LuckyPot by FreakingDev activated.");
	}

	public

	function onDisable()
	{
		$cfg = new Config($this->getDataFolder() . 'LuckyPot_DB.yml', Config::YAML);
		$cfg->setAll($this->config);
		$cfg->save();
		//$this->getLogger()->info(TextFormat::GREEN . "LuckyPot by FreakingDev disabled.");
	}

	public

	function onJoin(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		if ($player instanceof Player) {
			foreach($this->config as $coord => $pot) {
				$coord = explode(':', $coord);
				$x = $coord[0];
				$y = $coord[1];
				$z = $coord[2];
				if ($pot == "epic") {
					$text = TextFormat::LIGHT_PURPLE . "Epic Lucky Potn" . TextFormat::GREEN . "Win up to " . TextFormat::GOLD . "$1,000,000n" . TextFormat::AQUA . "Cost: " . TextFormat::GOLD . "$10000";
					$player->getLevel()->addParticle(new FloatingTextParticle(new Vector3($x + 0.5, $y + 3, $z + 0.5) , '', $text) , array(
						$player
					));
				}
			}
		}
	}

	public

	function onTouch(PlayerInteractEvent $event)
	{
		$player = $event->getPlayer();
		$b = $event->getBlock();
		if ($player instanceof Player) {
			foreach($this->config as $coord => $pot) {
				$coord = explode(':', $coord);
				$x = $coord[0];
				$y = $coord[1];
				$z = $coord[2];
				if ($b->x == $x && $b->y == $y + 2 && $b->z == $z) {
					if ($pot == "epic") {
						$this->epicPot($player);
					}
				}
			}
		}
	}

	public

	function onBlock(BlockBreakEvent $event)
	{
		$sender = $event->getPlayer();
		$b = $event->getBlock();
		if ($this->set == 1) {
			if ($this->pot == "epic") {
				$x = $b->getX();
				$y = $b->getY();
				$z = $b->getZ();
				$this->config[$x . ':' . $y . ':' . $z] = $this->pot;
				$cfg = new Config($this->getDataFolder() . 'LuckyPot_DB.yml', Config::YAML);
				$cfg->setAll($this->config);
				$cfg->save();
				$text = TextFormat::LIGHT_PURPLE . "Epic Lucky Potn" . TextFormat::GREEN . "Win up to " . TextFormat::GOLD . "$1,000,000n" . TextFormat::AQUA . "Cost: " . TextFormat::GOLD . "$10000";
				$b->getLevel()->addParticle(new FloatingTextParticle(new Vector3($x + 0.5, $y + 3, $z + 0.5) , '', $text));
				$b->getLevel()->setBlockIdAt($x, $y + 2, $z, 140);
				$b->getLevel()->setBlockIdAt($x, $y + 1, $z, 120);
				$sender->sendMessage(TextFormat::AQUA . "[LuckyPot] has been added");
				$this->set = 0;
			}
		}
	}

	public

	function onCommand(CommandSender $sender, Command $command, string $label, array $args):
		bool
		{
			if ($sender instanceof Player) {
				if ($sender->hasPermission("luckypot.addpot")) {
					if ($command->getName() == 'addpot') {
						$this->set = 1;
						$this->pot = $args[0];
						$sender->sendMessage("Break a block");
					}
				}
			}
			else {
				$sender->sendMessage(TextFormat::RED . "Use this Command in-game.");
				return true;
			}

			return true;
		}

		public

		function epicPot($player)
		{
			$money = EconomyAPI::getInstance()->myMoney($player);
			if ($money > 10000) {
				EconomyAPI::getInstance()->reduceMoney($player, 10000, true);
				switch (mt_rand(1, 20)) {
				case 1:
					EconomyAPI::getInstance()->addMoney($player, 10000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $10,000");
					break;

				case 2:
					EconomyAPI::getInstance()->addMoney($player, 50000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $50,000");
					break;

				case 3:
					EconomyAPI::getInstance()->addMoney($player, 100000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $100,000");
					break;

				case 4:
					EconomyAPI::getInstance()->addMoney($player, 500000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $500,000");
					break;

				case 5:
					EconomyAPI::getInstance()->addMoney($player, 1000000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000,000");
					break;

				case 6:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 7:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 8:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 9:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 10:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 11:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 12:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 13:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 14:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 15:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 16:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 17:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 18:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 19:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;

				case 20:
					EconomyAPI::getInstance()->addMoney($player, 1000, true);
					$player->sendMessage(TextFormat::GREEN . "Congratulations you've won $1,000");
					break;
				}
			}
			else {
				$player->sendMessage(TextFormat::RED . "You don't have enough money to use Epic Pot");
			}
		}
	}

