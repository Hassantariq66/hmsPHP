using System;
using Xamarin.Forms;
using System.Linq;
using Toasts;
using System.IO;
using System.Threading.Tasks;
using System.Runtime.Serialization.Formatters;
using System.Text.RegularExpressions;
​using System.Globalization;
namespace Moboom
{
	​
	public class RegisterView: ContentPage
	{
		public Boolean invalid = false;
		public StackLayout stackLayout;
		public ExtendedEntryField companyname;
		public ExtendedEntryField email;
		public View content;
		public LoginDetails accountinfo;
		public string themename;
		public Boolean  imagechanged=false;
		public Image logoimage=new Image();
		public string path="";
		public byte[] imageData;
		public ExtendedIndicator indicator;
		public RegisterView ()
		{
			​
			indicator=new ExtendedIndicator{
				Text="Creating Your Native iOS App",
				BackgroundColor=Settings.BackgroundColor,
			};
			BackgroundColor = Settings.BackgroundColor;
		
			stackLayout = new StackLayout {
				Spacing = 10,
				Padding = new Thickness (20, 20, 20, 20),
				VerticalOptions = LayoutOptions.Fill,
				Children = {
					new ExtendedLabel {
						Text = "Just One More Step",
						FontSize = Settings.FontSize.H2,
					},
				}
			};
			email = new ExtendedEntryField {
				LabelText = "Email",
				EntryText = "",
				​
			};
			​
			​
			companyname = new ExtendedEntryField {
				LabelText = "Company Name",
				EntryText = "",
			};
			email.Entry.PlaceHolder = "name@Moboom.com";
			companyname.Entry.PlaceHolder = "Your Compnay Name";
			​
			​			ExtendedButton Next = new ExtendedButton {
				Text = "Next"
			};
			stackLayout.Children.Add (email);
			​
			stackLayout.Children.Add (companyname);
			​
			​

			stackLayout.Children.Add (Next);
			Next.Clicked += OnSaveClicked;
			​
			​
			​
			this.Content = new StackLayout {
				Children = {
					new ScrollView {
						Content = stackLayout
					}
				}
			};
		}
		​
		async void OnSaveClicked (object sender, EventArgs args)
		{
			​
			if (email.EntryText != "" && companyname.EntryText != "") {
				​
				string emailstring = email.EntryText;
				string websitename = companyname.EntryText;
				if (checkemail (emailstring)) {
					bool checkuser = await checkUsername (emailstring);
					if(checkuser)
					{
						CreateAccountInfo registerInfo = new CreateAccountInfo ();
						registerInfo.first_name = "First Name";
						registerInfo.last_name = "Last Name";
						registerInfo.email = emailstring;
						registerInfo.organization_name = companyname.EntryText;
						registerInfo.password = "1234";
						registerInfo.password2 = "1234";
						registerInfo.terms = "1";
						​
						registerInfo.country_id = "c51cd468-7196-40e1-ba85-58bfbda25a0b";
						this.content = Content;
						​
						indicator.IsVisible=true;
						indicator.IsRunning=true;

						this.Content = indicator;
						string s=await App.BusinessLogic.Register (registerInfo);
						LoginInfo login = new LoginInfo ();
						login.username = emailstring;
						login.password = "1234";
						accountinfo = await App.BusinessLogic.Login (login);
						​
						​//changing to 20 percent
						indicator.Text="Creating Your Native Android App";

						string id = null;
						​
						if (accountinfo != null) {
							​
							//changed username and password for 
							Settings.Username=emailstring;
							Settings.Password="1234";
							​
							id = await App.BusinessLogic.GetSiteCollectionID ();
							​

							if (id != null) {
								Settings.SiteCollectionID = id;
								int i = App.BusinessLogic.SaveLoginDetails (accountinfo);
								​
							}
							​//changing to 40 percent
							//progressBar.Progress=.4;

							​
						}

						​indicator.Text="Creating your Desktop Website";
						​
						await OnCreateButtonClicked();
						​
						​//changing to 100 percent

						indicator.IsVisible=false;

						indicator.IsRunning=false;
						this.Content=this.content;
						​
						​
						PreviewPageView page=new PreviewPageView();
						var rootPage = new NavigationPage (page);
						await Navigation.PushModalAsync(rootPage);
						//UtilityFunctions.CustomToast (ToastNotificationType.Success, "Registration Successfull", "Your settings has saved",4);	
					}
					else
						UtilityFunctions.CustomToast (ToastNotificationType.Error, "Email Validation", "Email has Already taken.",4);
				}
				else
					UtilityFunctions.CustomToast (ToastNotificationType.Error, "Email Validation", "Please Type a correct Email.",4);
				​
			}else
				UtilityFunctions.CustomToast (ToastNotificationType.Error, "Email & App/Site", "Please Enter Email and App/Site name.",4);
			​
			​
		}
		public Boolean checkemail(string email)
		{
			
			invalid = false;
			if (String.IsNullOrEmpty(email))
				return false;

				// Use IdnMapping class to convert Unicode domain names.
				try {
				email = Regex.Replace(email, @"(@)(.+)$", this.DomainMapper,
						RegexOptions.None, TimeSpan.FromMilliseconds(200));
				}
				catch (RegexMatchTimeoutException) {
					return false;
				}

				if (invalid)
					return false;

				// Return true if strIn is in valid e-mail format.
				try {
					return Regex.IsMatch(email,
						@"^(?("")("".+?(?<!\\)""@)|(([0-9a-z]((\.(?!\.))|[-!#\$%&'\*\+/=\?\^`\{\}\|~\w])*)(?<=[0-9a-z])@))" +
						@"(?(\[)(\[(\d{1,3}\.){3}\d{1,3}\])|(([0-9a-z][-\w]*[0-9a-z]*\.)+[a-z0-9][\-a-z0-9]{0,22}[a-z0-9]))$",
						RegexOptions.IgnoreCase, TimeSpan.FromMilliseconds(250));
				}
				catch (RegexMatchTimeoutException) {
					return false;
				}
		}
		private string DomainMapper(Match match)
		{
			// IdnMapping class with default property values.
			IdnMapping idn = new IdnMapping();

			string domainName = match.Groups[2].Value;
			try {
				domainName = idn.GetAscii(domainName);
			}
			catch (ArgumentException) {
				invalid = true;
			}
			return match.Groups[1].Value + domainName;
		}
		public async Task<bool> checkUsername(string username)
		{
			string i=await App.BusinessLogic.checkUsername(username);
			if (i == "1") {
				return false;
			} else if (i == "0") {
				return true;
			} else
				return false;
		}
		async Task OnCreateButtonClicked ()
		{		
			​
			//content = this.Content;
			string themeid="";
			Settings.AmethystThemeID = "325e047a-a773-d021-bd63-53c7005d028d";
			Color backgroundColorforCreateSite=Settings.BackgroundColor;
			Color textColorForCreateSite=Settings.TextColor;
			//Checking which is selected
			​
			if (Settings.selectedTheme == "Bedford") {
				themeid= Settings.BedfordThemeID;
				backgroundColorforCreateSite = Settings.BedfordSiteBackgroundColor;
				textColorForCreateSite = Settings.BedfordSiteTextColor;
				​
				Settings.isAvalanche = false;
				​
			} else if (Settings.selectedTheme == "Avalanche") {
				themeid = Settings.AvalancheThemeID;
				backgroundColorforCreateSite = Settings.AvalancheSiteBackgroundColor;
				textColorForCreateSite = Settings.AvalancheSiteTextColor;
				​
			} else if (Settings.selectedTheme == "Amethyst") {
				themeid = Settings.AmethystThemeID;
				backgroundColorforCreateSite = Settings.AmythystSiteBackgroundColor;
				textColorForCreateSite = Settings.AmythystSiteTextColor;
				Settings.isAvalanche = false;
				​
			}
			string sitename=companyname.EntryText;
			​
			CreateSitePayload site = new CreateSitePayload ();
			site.site_collection_id = Settings.SiteCollectionID;
			site.site_theme_id = themeid;
			site.name = sitename;
			SiteDetail siteDetail = new SiteDetail ();
			siteDetail = await App.BusinessLogic.CreateSite (site);
			//here this must not going to interact directly to database
			if (siteDetail != null) {
				Settings.BackgroundColor = backgroundColorforCreateSite;
				Settings.ThemeID=themeid;
				Settings.TextColor = textColorForCreateSite;
				App.BusinessLogic.SaveSiteDetail (siteDetail);
				//saving site details
				​
				//changing themeid
				Settings.AppTitle = siteDetail.name;
				Settings.SiteID = siteDetail.id;
				Console.WriteLine ("Before Task !");
				//take it to 60
				Device.BeginInvokeOnMainThread (() => {
				indicator.Text="Creating your Mobile Website";
				});

				try {
					
					//await Task.Run (() => {
					Console.WriteLine ("Task Started !");
					if (siteDetail.site_theme_id == Settings.BedfordThemeID) {
						App.BusinessLogic.InitializeForBedford ();
					} else if (siteDetail.site_theme_id == Settings.AvalancheThemeID) {
						App.BusinessLogic.InitializeForAvalache ();
					} else if (siteDetail.site_theme_id == Settings.AmethystThemeID) {
						App.BusinessLogic.InitializeForAmethyst ();
					}

					​
					Settings.isFirstEverTime=false;
					App.BusinessLogic.UpdateAppkitSettings ();
				
				} catch (Exception ex) {
					Console.WriteLine ("After loading !");
					UtilityFunctions.CustomToast (ToastNotificationType.Error, "Error", "Connection Error.");
					Console.WriteLine (ex.Message);
				}

				​
			} else {
				Console.WriteLine ("After loading !");

				UtilityFunctions.CustomToast (ToastNotificationType.Error, "Error", "Connect to Internet.");
				​
			}
		}
	}
}